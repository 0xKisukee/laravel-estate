<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePropertyRequest;
use App\Models\User;
use App\Models\Property;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PropertyController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
          new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        $properties = Property::all();
        return response()->json($properties);
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
