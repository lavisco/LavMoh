<?php

namespace App\Services;
use Image;

class ImageService {
    public function storeUploadedImage($request)
    {
        $banner=null;
        if ($request->banner) {
            $file_name = time().'_'.$request->photoName;
            Image::make($request->banner)->save(storage_path('app/public/banners/').$file_name);
            $banner = 'banners/'.$file_name;
        }
        return $request->merge(['banner' => $banner]);
    }
}