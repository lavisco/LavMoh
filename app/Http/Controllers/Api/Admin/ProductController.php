<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Recipient;
use App\Models\Shipping;
use App\Models\Variation;
use App\Models\VariationOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        $userId = $request->user_id;
        $productStateId = $request->product_state_id;

        $request->merge([
            'slug' => Str::slug($request->title),
            'base_price' => $request->base_price ?? '0.00',
        ]);

        $product = new Product($request->all());
        $product->save();

        //sync to pivot tables
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));

        //product variation
        $this->storeVariation($request, $product->id, $userId, $productStateId);

        //product images
        $this->uploadImage($request, $product->id);
    }

    public function storeVariation($request, $productId, $userId, $productStateId)
    {
        if ($request->has('productVariation.0.option_name.0')) {

            $totalVariations = $request->input('productVariation.*.variation_name');
            $variationDescriptions = $request->input('productVariation.*.variation_description');
            $productVariations = $request->input('productVariation.*');
    
            $VariationOptionsArray = [];
            
            $counter = 0;
            for ($i = 0; $i < 3; $i++) {
                if ($totalVariations[$i]) {
                    $counter += 1;
                }
            }
    
            for ($i=0; $i < $counter; $i++) { 
                //form fields
                $variation_name = $totalVariations[$i];
                $variation_description = $variationDescriptions[$i];

                $option_name = $productVariations[$i]['option_name'];
                $option_sku = $productVariations[$i]['option_sku'];
                $option_price = $productVariations[$i]['option_price'];
                $option_quantity = $productVariations[$i]['option_quantity'];

                //create variation
                $variation = new Variation([
                    'name' => $variation_name,
                    'description' => $variation_description,
                    'product_id' => $productId,
                    'product_state_id' => $productStateId,
                ]);
                $variation->save();
    
                for ($j=0; $j < count($option_name); $j++) { 
                    array_push($VariationOptionsArray, [
                        //repeating
                        'variation_id' => $variation->id,
                        'product_id' => $productId,
                        'product_state_id' => $productStateId,
                        'user_id' => $userId,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        //non-repeating
                        'name' => $option_name[$j],
                        'sku' => $option_sku[$j] ?? null,
                        'price' => $option_price[$j] ?? '0.00',
                        'quantity' => $option_quantity[$j] ?? '0',
                    ]);
                }
            }

            VariationOption::insert($VariationOptionsArray); //bulk insert
        }
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

    public function show($id)
    {
        ///$this->authorize('view', $product);
        return Product::with(['occasions', 'recipients', 'shippings'])->findOrFail($id);
    }

    public function update(ProductRequest $request, Product $product)
    {
        ///$this->authorize('update', $product);
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
            $img = Image::make($image)->encode();
            Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());
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

    /**
     * Get data from other tables, that are needed during product listing
     */
    public function getDetails()
    {
        return response()->json([
            'categories' => Category::select('id', 'name')->latest()->get(),
            'occasions' => Occasion::select('id', 'name')->latest()->get(),
            'recipients' => Recipient::select('id', 'name')->latest()->get(),
            'shippings' => Shipping::latest()->get(),
        ]);
    }
}
