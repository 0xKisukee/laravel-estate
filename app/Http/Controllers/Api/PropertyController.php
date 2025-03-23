<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
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

    public function store(Request $request)
    {
        $property = Property::create($request->validated());

        return response()->json($property);
    }

    public function update(Property $property, Request $request)
    {

    }

    public function destroy(Property $property)
    {

    }
}
