<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIAuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|',
        ]);


        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }


         // Check if validation pass then create user and auth token. Return the auth token
         if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken($request->name)->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }


    public function login(Request $request)
    {        
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Invalid Entry'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hi '.$user->name.', welcome to home',
            'access_token' => $token, 'token_type' => 'Bearer', 
        ]);
    }

    // method for user logout and delete token
    public function logout(Request $request) {
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

}
