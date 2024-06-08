<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            session()->regenerate();

            csrf_token();

            $user = Auth::user();

            $token = $user->createToken('User')->plainTextToken;

            $cookieName = 'access_token';
            $cookieLifetime = 60 * 24;
        
            $cookie = cookie($cookieName, $token, $cookieLifetime);
    
            $url = '/admin';

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
                'url' => $url
            ])->withCookie($cookie);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $cookie = Cookie::forget('access_token');

        auth()->logout();
        Session()->flush();

        if($user){
            $user->tokens()->delete();
        }

        $url = '/';

        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful',
            'url' => $url
        ])->withoutCookie('access_token');
    }
}