<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // $user = Auth::guard('sanctum')->user();

        $cookieHeader = $request->header('Cookie');

        parse_str(str_replace('; ', '&', $cookieHeader), $cookies);
        $accessToken = $cookies['access_token'] ?? null;

        $token = PersonalAccessToken::findToken($accessToken);

        if($token){
            $user = User::find($token->tokenable_id);
        }

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Auth::setUser($user);

        $roles = explode(';', $role);
        foreach ($roles as $r) {
            if ($user->hasRole($r)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}