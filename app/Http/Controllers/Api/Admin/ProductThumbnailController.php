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
        //$img = Image::make($request->thumbnail)->encode()->resize(300, null);

        // resize the image so that the largest side fits within the limit; the smaller
        // side will be scaled to maintain the original aspect ratio
        $img = Image::make($request->thumbnail)->encode()->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if (ProductThumbnail::where('product_id', $request->id)->doesntExist()){
            Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());
            ProductThumbnail::create([
                'image_path' => 'products/'.$file_name,
                'product_id' => $request->id,
            ]);
        } else {
            $thumbnail = ProductThumbnail::where('product_id', $request->id)->first();
            Storage::disk('s3')->delete('public/'.$thumbnail->image_path);
            $thumbnail->update([
                'image_path' => 'products/'.$file_name,
            ]);
            Storage::disk('s3')->put('/public/products/'.$file_name, $img->stream());
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
