<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OccasionRequest;
use App\Models\Occasion;
use Illuminate\Http\Request;
use Image;

class OccasionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', Occasion::class);

        return Occasion::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(OccasionRequest $request)
    {
        ///$this->authorize('create', Occasion::class);

        $request->merge(['banner' => $this->storeImage($request->banner, $request->photoName)]);
        return Occasion::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $occasion);
        return Occasion::findOrFail($id);
    }

    public function update(OccasionRequest $request, Occasion $occasion)
    {
        ///$this->authorize('update', $occasion);

        $this->updateImage($request, $occasion->banner);
        $occasion->update($request->all());
    }

    public function destroy(Occasion $occasion)
    {
        ///$this->authorize('delete', $occasion);
        $occasion->delete();
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
