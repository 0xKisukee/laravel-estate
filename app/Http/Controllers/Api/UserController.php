<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Create a user
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', //'password_confirmation'
        ]);

        // Creates a new user
        $user = User::create([
            'role' => $request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'iban' => $request->iban,
            'bic' => $request->bic,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash password
        ]);

        // Return response
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);  // Created
    }
}
