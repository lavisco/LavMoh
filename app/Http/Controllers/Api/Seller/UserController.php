<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\SellerProfile;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller'])->only('storeShopSetup');
    }
    
    public function index()
    {
        //
    }

    public function store(UserRequest $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::IS_SELLER,
        ]);
    }

    public function storeShopSetup(SellerRegisterRequest $request)
    {
        $userid = Auth::user()->id;
        $request->merge(['user_id' => $userid]);
        $request->merge(['banner' => $this->storeImage($request->banner, $request->photoName)]);
        $request->merge(['name' => $request->shop_name]);

        SellerProfile::create($request->all());
        Shop::create($request->all());
    }

    /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $banner=null;
        if ($image) {
            $file_name = time().'_'.$name;
            Image::make($image)->save(storage_path('app/public/banners/').$file_name);
            $banner = 'banners/'.$file_name;
        }

        return $banner;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function updatePassword(UserRequest $request, User $model)
    {
        //$this->authorize('update', $model);
        $model->update([
            'password' => Hash::make($request->input('password')),
        ]);
        
    }
}
