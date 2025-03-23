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

    public function show($id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        return response()->json($property);
    }

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

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {

    }
}
