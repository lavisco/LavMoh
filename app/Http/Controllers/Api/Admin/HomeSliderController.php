<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSliderRequest;
use App\Models\HomeSlider;
use Illuminate\Support\Facades\Storage;
use Image;

class HomeSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', HomeSlider::class);

        return HomeSlider::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(HomeSliderRequest $request)
    {
        ///$this->authorize('create', HomeSlider::class);
        return HomeSlider::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $homeslider);
        return HomeSlider::findOrFail($id);
    }

    public function update(HomeSliderRequest $request, HomeSlider $homeslider)
    {
        ///$this->authorize('update', $homeslider);
        $homeslider->update($request->all());
    }

    public function destroy(HomeSlider $homeslider)
    {
        ///$this->authorize('delete', $homeslider);
        $homeslider->delete();
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
