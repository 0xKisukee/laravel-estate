<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function index()
    {

    }

    public function show(Property $property)
    {
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        return response()->json($property);
    }

    public function store(CreatePropertyRequest $request)
    {
        $property = request()->user()->ownedProperties()->create($request->validated());

        return response()->json($property);
    }

    public function update(Property $property, Request $request)
    {

    }

    public function destroy(Property $property)
    {

    }

    public function setTenant(Property $property, User $user)
    {
        $property->update(['tenant_id' => $user->id]);

        return response()->json($property);
    }

    public function removeTenant(Property $property)
    {
        $property->update(['tenant_id' => null]);

        return response()->json($property);
    }
}
