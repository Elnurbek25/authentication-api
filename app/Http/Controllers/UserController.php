<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Mail\SendEmailNotification;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {

        $image=$request->file('image');
        $avatar=$this->uploadFile($image,'avatar');

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'verification_token' => Str::random(64),
            'path'=>$avatar,
            'password'=>bcrypt($request->password),
        ]);
        
        SendEmailJob::dispatch($user);

        return response()->json([
            'success'=>true,
            'message'=>'Emailingzini tekshiring'
        ]);
    }
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user->email_verified_at) {
                Auth::logout();
                return response()->json([
                    'success'=>false,
                    'message'=>'Emailingizni tasdiqlang'
                ]);
            }
            $token=User::createToken('auth_token')->plainTextToken;
            return response()->json([
                'success'=>true,
                'token'=>$token,
                'user'=> new UserResource($user)
            ]);

        }

        return response()->json([
            'success'=>false,
            'message'=>'Email yoki parol xato'
        ]);
    }
    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success'=>false,
                'message'=>'Token not found'
            ]);
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json([
            'success'=>true,
            'message'=>'Email verified'
        ]);}
}