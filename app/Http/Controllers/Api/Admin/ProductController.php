<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Variation;
use App\Models\VariationOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Product::class);

        return Product::with('product_image')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ProductRequest $request)
    {
        ///$this->authorize('create', Product::class);

        $product = new Product($request->all());
        $product->save();

        $product->materials()->sync(request('product_material'));
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));

        //sync to pivot tables
        //$this->syncPivotData($product);

        //product images
        $this->uploadImage($request, $product->id);

        //product variation
        $this->storeVariation($request, $product->id);
    }

    public function syncPivotData($product)
    {
        $product->materials()->sync(request('product_material'));
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));
    }

    public function uploadImage($request, $productId)
    {
        for ($i=0; $i < count($request->image_path); $i++) { 
                $primary = $request->image_path[0] ? 1 : 0;
                ProductImage::create([
                    'image_path' => $this->storeImage($request->image_path[$i], $request->photoName[$i]),
                    'title' => $request->photoName[$i],
                    'primary_image' => $primary,
                    'product_id' => $productId,
                ]);
        }
    }

    public function storeVariation($request, $productId)
    {
        if ($request->has('productVariation.0.var_option_id_array.0')) {
            $var_option_id_array = $request->input('productVariation.*.var_option_id_array.*');
            $sku = $request->input('productVariation.*.sku.*');
            $var_price_array = $request->input('productVariation.*.var_price_array.*');
            $var_quantity_array = $request->input('productVariation.*.var_quantity_array.*');
            $var_description_array = $request->input('productVariation.*.var_description_array.*');
            $variation_id = $request->input('productVariation.*.variationIds.*');

            $productVariationArray = []; //array containg data of each variation option

            $length = count($var_option_id_array);

            for ($j=0; $j < $length; $j++) { 
                
                array_push($productVariationArray, [
                    //repeating
                    'product_id' => $productId,
                    'product_state_id' => $request->input('product_state_id'),
                    'user_id' => auth()->id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    //non-repeating
                    'type' => $variation_id[$j],
                    'type_option' => $var_option_id_array[$j],
                    'sku' => $sku[$j] ?? null,
                    'description' => $var_description_array[$j] ?? null,
                    'price' => $var_price_array[$j] ?? '0.00',
                    'quantity' => $var_quantity_array[$j] ?? '0',
                ]);
            }
            ProductVariation::insert($productVariationArray); //bulk insert
        }
    }

    public function show($id)
    {
        ///$this->authorize('view', $product);
        return Product::with(['materials', 'occasions', 'recipients', 'shippings'])->findOrFail($id);
    }

    public function update(ProductRequest $request, Product $product)
    {
        ///$this->authorize('update', $product);
        $product->materials()->sync(request('product_material'));
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));
        $product->update($request->all());
    }

    public function updateState(Request $request, Product $product)
    {
        ///$this->authorize('update', $product);
        $product->update([
            'product_state_id' => request('product_state_id'),
        ]);
    }

    public function destroy(Product $product)
    {
        ///$this->authorize('delete', $product);
        $product->delete();
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
