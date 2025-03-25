<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Message;
use App\Models\Property;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required|numeric',
            'type' => 'required|string|in:other,repair,payment',
            'description' => 'required|string',
        ]);

        $property = Property::findOrFail($validatedData['property_id']);

        $this->authorize('create', [Ticket::class, $property]);

        $ticket = Ticket::create([
            'type' => $validatedData['type'],
            'description' => $validatedData['description'],
            'property_id' => $property->id,
            'owner_id' => $property->owner_id,
            'tenant_id' => $property->tenant_id,
        ]);

        return response()->json($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update([
            'status' => $request->validate(['status' => 'required|string'])['status'],
        ]);

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
