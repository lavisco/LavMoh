<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', User::class);
        return User::with('role') 
                    ->latest()
                    ->filter(request(['searchText']))->get();
    }

    public function list()
    {
        ///$this->authorize('viewAny', User::class);
        return User::with('role') 
                    ->latest()
                    ->filter(request(['searchText']))->paginate(25);
    }

    public function seller()
    {
        ///$this->authorize('viewAny', Role::class);

        return Shop::get();
    }

    public function buyer()
    {
        ///$this->authorize('viewAny', Role::class);

        return User::where('role_id', Role::IS_BUYER)->get();
    }

    public function store(UserRequest $request)
    {
        ///$this->authorize('create', User::class);

        $request->merge([
            'avatar' => $this->storeImage($request->avatar, $request->photoName),
            'password' => Hash::make($request->input('password')),
            'status' => 1,
        ]);
        return User::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $user);
        return User::findOrFail($id);
    }

    public function update(UserRequest $request, User $user)
    {
        ///$this->authorize('update', $user);

        $this->updateImage($request, $user->avatar);
        $user->update($request->all());
    }

    public function updatePassword(UserRequest $request, User $user)
    {
        ///$this->authorize('update', $user);
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);
        
    }

    public function destroy(User $user)
    {
        ///$this->authorize('delete', $user);
        $user->delete();
    }

    /**
     * Store a newly created image in storage, and save the path to db.
     */
    
    public function storeImage($image, $name)
    {
        $avatar=null;
        if ($image) {
            $file_name = time().'_'.$name;
            Image::make($image)->save(storage_path('app/public/banners/').$file_name);
            $avatar = 'banners/'.$file_name;
        }

        return $avatar;
    }

    /**
     * Update image in storage(delete existing image and save the newly upload one), & save the path to db.
     */

    public function updateImage($request, $currentImage)
    {
        if($request->avatar != $currentImage){
            $request->merge(['avatar' => $this->storeImage($request->avatar, $request->photoName)]);

            $existingImage = storage_path('app/public/').$currentImage;
            if(file_exists($existingImage)){
                @unlink($existingImage);
            }
        }
    }
}
