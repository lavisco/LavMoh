<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Shipping;
use App\Models\Shop;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Shop::class);

        return Shop::with('user')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ShopRequest $request)
    {
        ///$this->authorize('create', Shop::class);

        $request->merge([
            'slug' => Str::slug($request->name),
            'banner' => $this->storeImage($request->banner, $request->photoName)
        ]);
        return Shop::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $shop);
        return Shop::findOrFail($id);
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        ///$this->authorize('update', $shop);

        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $this->updateImage($request, $shop->banner);
        $shop->update($request->all());

        //sync to pivot tables
        $shop->shippings()->sync(request('shop_shipping'));

        return ['message' => "Update Successful"];
    }

    public function destroy(Shop $shop)
    {
        ///$this->authorize('delete', $shop);
        $shop->delete();
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

    public function updateState(Request $request, Shop $shop)
    {
        ///$this->authorize('update', $shop);
        $shop->update([
            'status' => request('status'),
        ]);
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
