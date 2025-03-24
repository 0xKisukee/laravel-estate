<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token');

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    public function login(LoginRequest $request) {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Incorrect email or password.',
            ]);
        }

        $token = $user->createToken('auth_token');

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You are logged out.',
        ]);
    }
}
