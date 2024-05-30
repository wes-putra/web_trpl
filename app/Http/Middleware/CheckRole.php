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
        $user = Auth::guard('sanctum')->user();

        if(!$user){

            $accessToken = $request->cookie('access_token');

            $token = PersonalAccessToken::findToken($accessToken);

            if($token){
                $user = User::find($token->tokenable_id);
            }
        }

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $roles = explode(';', $role);
                
        foreach ($roles as $r) {
            if ($user->role_id == intval($r)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}