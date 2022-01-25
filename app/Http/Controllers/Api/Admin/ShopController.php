<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $request->merge(['banner' => $this->storeImage($request->banner, $request->photoName)]);
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

        $this->updateImage($request, $shop->banner);
        $shop->update($request->all());
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
            $img = Image::make($image)->encode();

            $file_name = time().'_'.$name;
            Storage::put($file_name, $img);
            Storage::move($file_name, 'banners/' . $file_name);
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
