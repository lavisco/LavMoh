<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Recipient;
use App\Models\Shipping;
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
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Product::class);
        return Product::where('user_id', auth()->id())->with(['product_images', 'product_image', 'product_variations', 'category'])->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ProductRequest $request)
    {
        //$this->authorize('create', Product::class);
        
        $request->merge([
            'product_state_id' => 1,
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->title),
        ]);
        $product = new Product($request->all());

        $product->save();

        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));

        //product variation
        $this->storeVariation($request, $product->id);

        //product images
        $this->uploadImage($request, $product->id);
    }

    public function storeNewImage(Request $request, $productId)
    {        
        //product images
        //$this->uploadImage($request, $productId);

        for ($i=0; $i < count($request->image_path_new); $i++) { 
            ProductImage::create([
                'image_path' => $this->storeImage($request->image_path_new[$i], $request->photoName[$i]),
                'title' => $request->photoName[$i],
                'primary_image' => false,
                'product_id' => $productId,
            ]);
        }
    }

    public function uploadImage($request, $productId)
    {
        for ($i=0; $i < count($request->image_path); $i++) { 
                $primary = $request->image_path[$i] == $request->image_path[0] ? true : false;
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
        if ($request->has('productVariation.0.variation_type_option.0')) {

            // $variation_type_option = $request->input('productVariation.*.variation_type_option.*');
            // $sku = $request->input('productVariation.*.sku.*');
            // $variation_price = $request->input('productVariation.*.variation_price.*');
            // $variation_quantity = $request->input('productVariation.*.variation_quantity.*');
            // $variation_description = $request->input('productVariation.*.variation_description.*');
            // $variation_type = $request->input('productVariation.*.variation_type.*');

            // $productVariationArray = []; //array containg data of each variation option

            // for ($j=0; $j < count($variation_type_option); $j++) { 
            //     array_push($productVariationArray, [
            //         //repeating
            //         'product_id' => $productId,
            //         'product_state_id' => 1,
            //         'user_id' => auth()->id(),
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //         //non-repeating
            //         'type' => $variation_type[$j],
            //         'type_option' => $variation_type_option[$j],
            //         'sku' => $sku[$j] ?? null,
            //         'description' => $variation_description[$j] ?? null,
            //         'price' => $variation_price[$j] ?? '0.00',
            //         'quantity' => $variation_quantity[$j] ?? '0',
            //     ]);
            // }

            $variations = $request->input('productVariation.*.variationId');
            $variationDescriptions = $request->input('productVariation.*.variationDescription');
            $productVariations = $request->input('productVariation.*');
    
            $productVariationArray = [];
            
            $counter = 0;
            for ($i = 0; $i < 3; $i++) {
                if ($variations[$i]) {
                    $counter += 1;
                }
            }
    
            for ($i=0; $i < $counter; $i++) { 
                $variation_type = $variations[$i];
                $variation_description = $variationDescriptions[$i];
                $type_option = $productVariations[$i]['variation_type_option'];
                $sku = $productVariations[$i]['sku'];
                $variation_price = $productVariations[$i]['variation_price'];
                $variation_quantity = $productVariations[$i]['variation_quantity'];
    
                for ($j=0; $j < count($type_option); $j++) { 
                    array_push($productVariationArray, [
                        //repeating
                        'product_id' => $productId,
                        'product_state_id' => 1,
                        'user_id' => auth()->id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'type' => $variation_type,
                        'description' => $variation_description,
                        //non-repeating
                        'type_option' => $type_option[$j],
                        'sku' => $sku[$j] ?? null,
                        'price' => $variation_price[$j] ?? '0.00',
                        'quantity' => $variation_quantity[$j] ?? '0',
                    ]);
                }
            }

            ProductVariation::insert($productVariationArray); //bulk insert
        }
    }

    public function show($id)
    {
        ///$this->authorize('view', $product);
        return Product::with(['occasions', 'recipients', 'shippings'])->findOrFail($id);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $product->update($request->all());
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->shippings()->sync(request('product_shipping'));
    }

    public function updateState(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update([
            'product_state_id' => request('product_state_id'),
        ]);
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
