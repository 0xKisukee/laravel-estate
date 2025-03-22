<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    // Create a new property
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'rent' => 'required|numeric',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $property = Property::create($validated);

        return response()->json($property, 201);
    }

    // Get a specific property by ID
    public function show($id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        return response()->json($property);
    }

    // Get a list of properties
    public function getAll()
    {
        $properties = Property::all();
        return response()->json($properties);
    }
}
