<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipientRequest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Image;

class RecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', Recipient::class);

        return Recipient::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(RecipientRequest $request)
    {
        ///$this->authorize('create', Recipient::class);

        $request->merge(['banner' => $this->storeImage($request->banner, $request->photoName)]);
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
            Image::make($image)->save(storage_path('app/public/banners/').$file_name);
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
