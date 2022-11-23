<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return SubCategory::with('category')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SubCategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
            'banner' => $this->storeImage($request->banner, $request->photoName)
        ]);
        SubCategory::create($request->all());
    }

    public function show($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $this->updateImage($request, $subCategory->banner);
        $subCategory->update($request->all());
    }

    public function destroy(SubCategory $subCategory)
    {
        ///$this->authorize('delete', $subCategory);
        $subCategory->delete();
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
