<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

    }

    public function show(Property $property)
    {
        $this->authorize('view', $property);

        return response()->json($property);
    }

    public function store(CreatePropertyRequest $request)
    {
        $this->authorize('create', Property::class);

        $owner = request()->user()->profile();

        $property = $owner->prop()->create($request->validated());

        return response()->json(new PropertyResource($property));
    }

    public function update(Property $property, Request $request)
    {
        $this->authorize('update', $property);

        // Owner can either set a tenant, remove a tenant
        // or completely edit property infos
        $validatedData = $request->validate([
            'tenant_id' => 'integer|exists:users,id|nullable', // new tenant, set to null to remove tenant
        ]);

        // USE "entry_date" HERE TO CREATE FIRST PAYMENT

        $property->update($validatedData);

        return response()->json($property);
    }

    public function destroy(Property $property)
    {

    }

}
