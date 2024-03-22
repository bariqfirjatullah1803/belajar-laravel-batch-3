<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "code" => 422,
                "message" => "Validation error.",
                "data" => $validator->errors()
            ], 422);
        }

        if (
            !Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])
        ) {

            return response()->json([
                "success" => false,
                "code" => 401,
                "message" => "Credentials error.",
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken("Laravel123");

        return response()->json([
            "success" => true,
            "code" => 200,
            "message" => "Login successfully.",
            "data" => [
                "email" => $user->email,
                "token" => [
                    "token" => $token->plainTextToken,
                    "type" => "Bearer"
                ]
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "code" => 422,
                "message" => "Validation error.",
                "data" => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "success" => true,
            "code" => 201,
            "message" => "Register successfully",
            "data" => [
                'email' => $user->email
            ]
        ], 201);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            "success" => true,
            "code" => 201,
            "message" => "Logout successfully.",
            "data" => null
        ], 200);
    }
}
