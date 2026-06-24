<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function store()
    {
        $validate = request()->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', Password::min(6), 'confirmed']
            ]
        );
        Auth::login(User::create($validate));
        return response()->json([
            'message' => "success",

        ], 201);
    }
    public function login()
    {
        $attributes = request()->validate([
            'email' => ["required"],
            "password" => ["required"]
        ]);
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'sorry, those credentials do not match']);
        }
        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'message' => 'success login',
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "success logout"
        ]);
    }
}
