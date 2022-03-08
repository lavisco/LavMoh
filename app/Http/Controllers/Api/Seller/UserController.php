<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\SellerRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\SellerProfile;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller'])->only('storeShopSetup', 'updatePassword');
    }
    
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::IS_SELLER,
        ]);

        event(new Registered($user));
    }

    public function storeShopSetup(SellerRegisterRequest $request)
    {      
        $request->merge([
            'user_id' => Auth::user()->id,
            'country' => "Sri Lanka"
        ]);

        SellerProfile::create($request->all());

        $request->merge([
            'user_id' => Auth::user()->id,
            'name' => $request->shop_name,
            'slug' => Str::slug($request->title),
            'province' => $request->shop_province,
            'district' => $request->shop_district,
            'city' => $request->shop_city,
            'area' => $request->shop_area,
            'address' => $request->shop_address,
            'zipcode' => $request->shop_zipcode,
            'status' => false,
            'banner' => $this->storeImage($request->banner, $request->photoName)
        ]);

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
            $img = Image::make($image)->encode();
            Storage::disk('s3')->put('/public/banners/'.$file_name, $img->stream());
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

    public function updatePassword(PasswordRequest $request)
    {
        //$this->authorize('update', $model);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    }
}
