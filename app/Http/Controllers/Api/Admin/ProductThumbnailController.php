<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\ProductThumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductThumbnailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $file_name = 'thumbnail'.time().'_'.$request->photoName;
        $img = Image::make($request->thumbnail)->encode()->resize(300, null);
        Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());

        if (ProductThumbnail::where('product_id', $request->id)->doesntExist()){
            ProductThumbnail::create([
                'image_path' => 'products/'.$file_name,
                'product_id' => $request->id,
            ]);
        } else {
            $thumbnail = ProductThumbnail::where('product_id', $request->id)->first();
            $thumbnail->update([
                'image_path' => 'products/'.$file_name,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
