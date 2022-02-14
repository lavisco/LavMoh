<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipientRequest;
use App\Models\Recipient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class RecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Recipient::class);

        return Recipient::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(RecipientRequest $request)
    {
        ///$this->authorize('create', Recipient::class);

        $request->merge([
            'slug' => Str::slug($request->name),
            'banner' => $this->storeImage($request->banner, $request->photoName)
        ]);
        return Recipient::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $recipient);
        return Recipient::findOrFail($id);
    }

    public function update(RecipientRequest $request, Recipient $recipient)
    {
        ///$this->authorize('update', $recipient);

        $this->updateImage($request, $recipient->banner);
        $recipient->update($request->all());
    }

    public function destroy(Recipient $recipient)
    {
        ///$this->authorize('delete', $recipient);
        $recipient->delete();
    }

    /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $banner=null;
        if ($image) {
            $file_name = time().'_'.$name;
            $img = Image::make($image)->encode();
            Storage::disk('s3')->put('/public/banners/'.$file_name, $img->stream());
            $banner = 'banners/'.$file_name;
        }

        return $banner;
    }

    /**
     * Update image in storage(delete existing image and save the newly upload one), & save the path to db.
     */

    public function updateImage($request, $currentImage)
    {
        if($request->banner != $currentImage){
            $request->merge(['banner' => $this->storeImage($request->banner, $request->photoName)]);

            $existingImage = storage_path('app/public/').$currentImage;
            if(file_exists($existingImage)){
                @unlink($existingImage);
            }
        }
    }
}
