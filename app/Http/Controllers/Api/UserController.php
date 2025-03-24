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
}
