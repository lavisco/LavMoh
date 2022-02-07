<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\GiftwrapRequest;
use App\Models\Giftwrap;
use Illuminate\Http\Request;

class GiftwrapController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        return Giftwrap::where('user_id', auth()->id())->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(GiftwrapRequest $request)
    {
        $request->merge([
            'image_url' => $this->storeImage($request->image_url, $request->photoName),
            'user_id' => auth()->id(),
        ]);
        return Giftwrap::create($request->all());
    }

    public function show($id)
    {
        return Giftwrap::findOrFail($id);
    }

    public function update(GiftwrapRequest $request, Giftwrap $giftwrap)
    {
        ///$this->authorize('update', $giftwrap);

        $this->updateImage($request, $giftwrap->image_url);
        $giftwrap->update($request->all());
    }

    public function destroy(Giftwrap $giftwrap)
    {
        $giftwrap->delete();
    }

    /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $image_url=null;
        if ($image) {
            $file_name = time().'_'.$name;
            Image::make($image)->save(storage_path('app/public/banners/').$file_name);
            $image_url = 'banners/'.$file_name;
        }

        return $image_url;
    }

    /**
     * Update image in storage(delete existing image and save the newly upload one), & save the path to db.
     */

    public function updateImage($request, $currentImage)
    {
        if($request->image_url != $currentImage){
            $request->merge(['image_url' => $this->storeImage($request->image_url, $request->photoName)]);

            $existingImage = storage_path('app/public/').$currentImage;
            if(file_exists($existingImage)){
                @unlink($existingImage);
            }
        }
    }
}
