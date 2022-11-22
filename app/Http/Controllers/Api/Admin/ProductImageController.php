<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', ProductImage::class);

        return ProductImage::where('product_id', request('productId'))->get();
    }

    public function store(ProductImageRequest $request)
    {
        ///$this->authorize('create', ProductImage::class);
        return ProductImage::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $productimage);
        return ProductImage::findOrFail($id);
    }

    public function update(ProductImageRequest $request, Product $product)
    {
        ///$this->authorize('update', $productimage);

        for ($i=0; $i < count($request->image_id); $i++) { 
            $productImage = ProductImage::findOrFail($request->image_id[$i]);

            if ($request->image_path[$i] != $productImage->image_path) {

                $file_name = time().'_'.$request->image_title[$i];
                $image = $request->image_path[$i];

                $img = Image::make($image)->encode();
                Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());

                $productPhoto = 'products/'.$file_name;

                $productImage->update([
                    'image_path' => $productPhoto,
                    'title' => $request->image_title[$i],
                    'primary_image' => $request->primary_image[$i],
                ]);
            }
        }

         //create thumbnail if doesnt exist
        // $this->uploadThumbnailImage($request, $product->id);
    }

        /**
     * Store a image thumbnail in storage, and save the path to db.
     */

    
    public function uploadThumbnailImage($request, $productId)
    {
        if (ProductThumbnail::where('product_id', $productId)->doesntExist()) {
            $primaryImage = ProductImage::where('product_id', $productId)->where('primary_image', 1)->first();
            
            for ($i=0; $i < count($request->image_path); $i++) { 
                if($request->image_path[$i] == $primaryImage->image_path){
                    ProductImage::create([
                        'image_path' => $this->storeThumbnailImage($request->image_path[$i], $primaryImage->title),
                        'product_id' => $productId,
                    ]);
                }
            }
        }
        
    }
    
    public function storeThumbnailImage($image, $name)
    {
        if ($image) {
            $file_name = 'thumbnail'.time().'_'.$name;
            $img = Image::make($image)->encode('webp');
            Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());
        }
    }

    public function destroy(ProductImage $productimage)
    {
        ///$this->authorize('delete', $productimage);
        $productimage->delete();
    }

    /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $productPhoto=null;
        if ($image) {
            $file_name = time().'_'.$name;
            Image::make($image)->save(storage_path('app/public/products/').$file_name);
            $productPhoto = 'products/'.$file_name;
        }

        return $productPhoto;
    }

    /**
     * Update image in storage(delete existing image and save the newly upload one), & save the path to db.
     */

    public function updateImage($request, $requestImage, $currentImage)
    {
        if($requestImage != $currentImage){
            $request->merge(['image_path' => $this->storeImage($requestImage, $request->photoName)]);

            $existingImage = storage_path('app/public/').$currentImage;
            if(file_exists($existingImage)){
                @unlink($existingImage);
            }
        }
    }
}
