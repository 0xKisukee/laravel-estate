<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
        /* deprecated: now using sanctum
        $user = User::create($request->validated());

        return response()->json($user);
        */
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
        // request() parameter can be used in the resource toArray method
        $userArray = (new UserResource($user))->toArray(request());
        $payments = $userArray['payments'];

        return response()->json($payments);
    }
}
