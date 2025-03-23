<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Create a user
    public function register(RegisterRequest $request)
    {
        // Creates a new user
        $user = User::create($request->validated());

        // Return response
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);  // Created
    }
}
