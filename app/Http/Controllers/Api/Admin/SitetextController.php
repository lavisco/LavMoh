<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SitetextRequest;
use App\Models\Sitetext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class SitetextController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Sitetext::class);

        return Sitetext::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SitetextRequest $request)
    {
        ///$this->authorize('create', Sitetext::class);
        if($request->contentType == 'image'){
            $request->merge([
                'content' => $this->storeImage($request->content, $request->photoName)
            ]);
        }
        
        return Sitetext::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $sitetext);
        return Sitetext::findOrFail($id);
    }

    public function update(SitetextRequest $request, Sitetext $sitetext)
    {
        ///$this->authorize('update', $sitetext);

        if($request->contentType == 'image'){
            $this->updateImage($request, $sitetext->content);
        }
        $sitetext->update($request->all());
    }

    public function destroy(Sitetext $sitetext)
    {
        ///$this->authorize('delete', $sitetext);
        $sitetext->delete();
    }

        /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $content=null;
        if ($image) {
            $file_name = time().'_'.$name;
            $img = Image::make($image)->encode();
            Storage::disk('s3')->put('/public/images/'.$file_name, $img->stream());
            $content = 'images/'.$file_name;
        }

        return $content;
    }

    /**
     * Update image in storage(delete existing image and save the newly upload one), & save the path to db.
     */

    public function updateImage($request, $currentImage)
    {
        if($request->content != $currentImage){
            $request->merge(['content' => $this->storeImage($request->content, $request->photoName)]);

            $existingImage = storage_path('app/public/').$currentImage;
            if(file_exists($existingImage)){
                @unlink($existingImage);
            }
        }
    }
}
