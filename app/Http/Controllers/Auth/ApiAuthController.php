<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Tymon\JWTAuth;

class ApiAuthController extends Controller
{
    /**
     * Api Login method
     */
    public function login() {
        $credentials = request(['email', 'password']);
        
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'type' => 'bearer', // you can ommit this
            'expires' => auth('admin')->factory()->getTTL() * 60, // time to expiration
            'user' => auth('admin')->user(),
            
        ]);
    }

    /**
     * Logout token
     */
    public function logout()
    {
        return auth('admin')->logout();
    }
}
