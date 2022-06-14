<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Category::class);

        return Category::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(CategoryRequest $request)
    {
        ///$this->authorize('create', Category::class);
        $request->merge([
            'slug' => Str::slug($request->name),
            'banner' => $this->storeImage($request->banner, $request->photoName)
        ]);
        Category::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $category);
        return Category::findOrFail($id);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        ///$this->authorize('update', $category);

        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        $this->updateImage($request, $category->banner);
        $category->update($request->all());
    }

    public function destroy(Category $category)
    {
        ///$this->authorize('delete', $category);
        $category->delete();
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
