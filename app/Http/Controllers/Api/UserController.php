<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return (new UserResource($user));
    }

    public function store(RegisterRequest $request)
    {

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
        $this->authorize('getPayments', $user);

        $userArray = (new UserResource($user))->toArray(request());
        $payments = $userArray['payments'];

        return response()->json($payments);
    }

    public function getTickets(User $user) {
        $this->authorize('getTickets', $user);

        $userArray = (new UserResource($user))->toArray(request());
        $tickets = $userArray['tickets'];

        return response()->json($tickets);
    }
}
