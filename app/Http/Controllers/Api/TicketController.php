<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Property;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTicketRequest;

class TicketController extends Controller
{
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
    public function store(CreateTicketRequest $request)
    {
        $property = Property::findOrFail($request->validated()['property_id']);

        $ticket = Ticket::create([
            'type' => $request->validated()['type'],
            'description' => $request->validated()['description'],
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
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'status' => $request->status,
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

    public function getTickets(User $user, Request $request) {
        $userArray = (new UserResource($user))->toArray(request());
        $tickets = $userArray['tickets'];

        return response()->json($tickets);
    }
}
