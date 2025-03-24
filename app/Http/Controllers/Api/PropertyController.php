<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
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

        $property = request()->user()->ownedProperties()->create($request->validated());

        return response()->json($property);
    }

    public function update(Property $property, Request $request)
    {

    }

    public function destroy(Property $property)
    {

    }

    public function setTenant(Property $property, Request $request)
    {
        $this->authorize('update', $property);

        // Here we need to get 'entry_date' from the body to calculate first payment
        $property->update([
            'tenant_id' => $request->validate(['tenant_id' => 'required'])['tenant_id']
        ]);

        return response()->json($property);
    }

    public function removeTenant(Property $property)
    {
        $this->authorize('update', $property);

        $property->update(['tenant_id' => null]);

        return response()->json($property);
    }
}
