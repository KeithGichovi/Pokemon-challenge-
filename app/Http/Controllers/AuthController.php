<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if($password !== $password_confirmation){
            return response()->json(['message' => 'Passwords do not match'], 400);
        }
        // check if the user already exists
        $existing_user = User::where('email', $email)->first();

        if($existing_user){
            return response()->json(['message' => 'A User with this email already exists'], 409);
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),

        ]);
        // return a response saying the user was created successfully
        return response()->json(['message' => 'User created successfully'], 201);

    }

    public function Login(Request $request) {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $user = Auth::user();

            $token = $user->createToken('pokemonbuild')->plainTextToken;

            // Return a success response with token
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function Logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token deleted successfully',
        ], 200);
    }

}
