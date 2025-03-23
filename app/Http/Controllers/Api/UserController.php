<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

    }

    public function show(User $user)
    {

    }

    // Create a user
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json($user);
    }

    public function update(User $user, Request $request)
    {

    }

    public function destroy(User $user)
    {

    }

    public function getOwnerProperties(User $user) {
        $properties = $user->ownedProperties;

        return response()->json($properties);
    }

    public function getTenantProperty(User $user) {
        $properties = $user->rentedProperty;

        return response()->json($properties);
    }

    public function getPayments(User $user) {
        if ($user->isOwner()) {
            $payments = $user->ownerPayments;
        } else {
            $payments = $user->tenantPayments;
        }

        return response()->json($payments);
    }
}
