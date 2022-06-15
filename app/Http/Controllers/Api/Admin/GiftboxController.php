<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GiftboxRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\GiftboxProduct;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class GiftboxController extends Controller
{
    /*
    *   this controller is for giftboxes, which are actually 
    *   stored in db as products
    */
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Product::class);
        return Product::where('category_id', 7)->with(['product_image', 'category', 'giftbox_products', 'giftbox_products.childProduct'])->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(GiftboxRequest $request)
    {
        //$this->authorize('create', Product::class);
        
        $request->merge([
            'product_state_id' => 1,
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->title),
            'category_id' => 7,
            'description' => $request->short_description,
            'has_inventory' => false,
            'quantity' => 0,
        ]);
        $product = new Product($request->all());

        $product->save();

        $product->update([
            'code' => 'LP'.str_pad($product->id,5,"0",STR_PAD_LEFT),
        ]);

        //sync to pivot tables
        $product->occasions()->sync(request('product_occasion'));
        $product->recipients()->sync(request('product_recipient'));

        //product images
        $this->uploadImage($request, $product->id);

        //save products available in this giftbox
        $this->storeGiftboxProducts($request, $product->id);
    }

        
    /**
     * save products that are available in this giftbox in storage.
     */
    public function storeGiftboxProducts(Request $request, $productId)
    {        
        //save products & their quantity, that are available in this giftbox

        $giftboxProducts = $request->input('giftbox_product.*');

        for ($i=0; $i < count($giftboxProducts); $i++) { 
            GiftboxProduct::create([
                'product_id' => $giftboxProducts[$i]['id'],
                'quantity' => $giftboxProducts[$i]['quantity'],
                'giftbox_id' => $productId,
            ]);
        }
    }

    
    /**
     * Update products a particular giftbox in storage.
     */
    public function updateGiftboxProducts(Request $request, $productId)
    {
            //!!!!!!!!!!!!!!or find all products in a giftbox, delete them all and save again newly
        $giftboxProducts = $request->input('giftbox_product.*');
       
        for ($i=0; $i < count($giftboxProducts); $i++) { 
            $giftboxProduct = GiftboxProduct::findOrFail($giftboxProducts[$i]['id']);
            
            $giftboxProduct->update([
                'product_id' => $giftboxProducts[$i]['id'],
                'quantity' => $giftboxProducts[$i]['quantity'],
            ]);
        }
    }

    public function uploadImage($request, $productId)
    {
        ProductImage::create([
            'image_path' => $this->storeImage($request->image_path, $request->photoName),
            'title' => $request->photoName,
            'primary_image' => true,
            'product_id' => $productId,
        ]);
    }

    public function show($id)
    {
        ///$this->authorize('view', $product);
        return Product::with(['occasions', 'recipients', 'shippings', 'sub_categories'])->findOrFail($id);
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
            'occasions' => Occasion::select('id', 'name')->latest()->get(),
            'recipients' => Recipient::select('id', 'name')->latest()->get(),
            'products' => Product::where('has_variations', false)->where('product_state_id', 1)->where('category_id','!=', 7)->select('id', 'code', 'title', 'base_price')->latest()->get(),
        ]);
    }
}
