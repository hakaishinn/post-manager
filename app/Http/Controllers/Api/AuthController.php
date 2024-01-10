<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        if (!auth()->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            return response(['message' => 'Invalid Credentials']);
        }
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->tokens()->delete();
        $accessToken = $user->createToken('access_token')->accessToken;
        return response()->json([
            'user_id' => $user->id,
            'username' => $user->username,
            'accessToken' => $accessToken,
        ]);
    }
}
