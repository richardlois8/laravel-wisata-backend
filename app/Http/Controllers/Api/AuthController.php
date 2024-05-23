<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        //check user
        if (!$user){
            return response([
                'status' => 'failed',
                'message' => 'User not found',
            ], 404);
        }

        if(!Hash::check($request->password, $user->password)){
            return response([
                'status' => 'failed',
               'message' => 'Invalid email or password'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Log out successfully'
        ], 200);
    }
}
