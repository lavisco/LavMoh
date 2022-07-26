<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Recipient;
use App\Models\Shipping;
use App\Models\SubCategory;
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
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Product::class);
        return Product::where('user_id', auth()->id())->where('category_id', '!=', 7)->with(['product_images', 'product_image', 'variations', 'variations.variation_options', 'category', 'sub_categories'])->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ProductRequest $request)
    {
        //$this->authorize('create', Product::class);
        
        $request->merge([
            'product_state_id' => 1,
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->title),
            'base_price' => $request->base_price ?? '0.00',
        ]);
        $product = new Product($request->all());

        $product->save();

        $product->update([
            'code' => 'LP'.str_pad($product->id,5,"0",STR_PAD_LEFT),
        ]);

        //sync to pivot tables
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->sub_categories()->sync(request('product_sub_category'));

        //product variation
        $this->storeVariation($request, $product->id);

        //product images
        $this->uploadImage($request, $product->id);
    }

    public function storeVariation($request, $productId)
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
                    'product_state_id' => 1,
                ]);
                $variation->save();
    
                for ($j=0; $j < count($option_name); $j++) { 
                    array_push($VariationOptionsArray, [
                        //repeating
                        'variation_id' => $variation->id,
                        'product_id' => $productId,
                        'product_state_id' => 1,
                        'user_id' => auth()->id(),
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

    public function storeNewImage(Request $request, $productId)
    {        
        //create new product images for existing product listing
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

    public function show($id)
    {
        ///$this->authorize('view', $product);
        return Product::with(['occasions', 'recipients', 'sub_categories'])->findOrFail($id);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->merge([
            'code' => 'LP'.str_pad($product->id,5,"0",STR_PAD_LEFT),
            'slug' => Str::slug($request->title),
        ]);

        $product->update($request->all());
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));
        $product->sub_categories()->sync(request('product_sub_category'));
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

    /**
     * Get data from other tables, that are needed during product listing
     */
    public function getDetails()
    {
        return response()->json([
            'categories' => Category::select('id', 'name')->where('status', 1)->latest()->get(),
            'occasions' => Occasion::select('id', 'name')->where('status', 1)->latest()->get(),
            'recipients' => Recipient::select('id', 'name')->where('status', 1)->latest()->get(),
            'shippings' => Shipping::latest()->get(),
        ]);
    }

    /**
     * Get data from other tables, that are needed during product listing
     */
    public function getSubcategories($categoryId)
    {
        return response()->json([
            'sub_categories' => SubCategory::where('category_id', $categoryId)->where('status', 1)->get(),
        ]);
    }
}
