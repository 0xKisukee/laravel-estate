<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {

    }
    // Create a user
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json($user);
    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {

    }

    public function getOwnerProperties($id) {
        $properties = User::find($id)->ownedProperties;

        return response()->json($properties);
    }

    public function getTenantProperty($id) {
        $properties = User::find($id)->rentedProperty;

        return response()->json($properties);
    }

    public function getPayments($id) {
//      WITH AUTH:
//      Auth::login(User::find($id));
//      $user = Auth::user();

//      WITHOUT AUTH:
        $user = User::find($id);

        // Then
        if ($user->isOwner()) {
            $payments = $user->ownerPayments;
        } else {
            $payments = $user->tenantPayments;
        }

        return response()->json($payments);
    }
}
