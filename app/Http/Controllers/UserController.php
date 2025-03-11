<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt( $request->password),
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadPhoto($image, 'images'); 
    
            Image::create([
                'path' => $imagePath,
                'imageable_id' => $user->id,
                'imageable_type' => User::class, 
            ]);
        $token =$user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'success'=>true,
            'token'=>$token,
            'user'=> new UserResource($user->load('image'))
        ]);
    }
    }
    public function login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
    if(!$user || !Hash::check($request->password,$user->password))
    {
        return response()->json(
            [
                'success'=>false
            ],401
            );
    }
    $user->tokens()->delete();
    $token=$user->createToken('auth_book')->plainTextToken;
    return response()->json([
        'success'=>true,
        'token'=>$token,
        'user'=> new UserResource($user->load('image'))

    ]);
    }
    public function logout(Request $request){
        $user=$request->user();
        $user->tokens->delete();
        return response()->json([
            'message'=>'Siz logout qildingiz'
        ]);
    }
}
