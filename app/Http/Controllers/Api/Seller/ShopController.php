<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Shipping;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Shop::class);
        return Shop::where('user_id', auth()->id())->with('shippings:id')->first();
    }

    public function store(ShopRequest $request)
    {
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        ///$this->authorize('update', $shop);
        $this->updateImage($request, $shop->banner);

        $request->merge([
            'country' => "Sri Lanka"
        ]);
        
        $shop->update($request->all());

        //sync to pivot tables
        $shop->shippings()->sync(request('shop_shipping'));

        return ['message' => "Update Successful"];
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

    
    /**
     * Get data from other tables, that are needed
     */
    public function getShippings()
    {
        return response()->json([
            'shippings' => Shipping::latest()->get(),
        ]);
    }
}
