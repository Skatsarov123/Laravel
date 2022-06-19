<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register (Request $request){

        $fields = $request->validate([
            'email' =>'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
//            'address' => 'required|string',
//            'phone' => 'required|string',
//            'department' => 'required|string',
//            'position' => 'required|string',
//            'salary' => 'required|string',
            ]);
        $user = User::create([

            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),

        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function logout()
    {
        Auth::logout();
    }
}
