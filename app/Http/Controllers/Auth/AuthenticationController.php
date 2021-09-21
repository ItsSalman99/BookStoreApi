<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            $user,
            $token
        ];

        return response($response, 201);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthenticated!'
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in login !'
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'login_token' => $token,
        ]);

    }

    public function signout()
    {
        auth()->user()->tokens()->delete();
        
        return response()->json(
            [
                'message' => 'Signed Out!'
            ]
        ); 
    }

}
