<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([

            'email'=>'required|email',
            'password'=>'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $attempt = auth()->attempt([
            'email' => 'appuserum@gmail.com',
            'password' => '123123'
        ]);

        if(!$attempt){
            return ApiResponse::unauthorized();
        }

        $user = auth()->user();

        // $token = $user->createToken($user->name)->plainTextToken;
        // $token = $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;
        $token = $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;

        return ApiResponse::success([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token,

        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logout with success');
    }
}
