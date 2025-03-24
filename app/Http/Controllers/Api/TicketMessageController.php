<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TicketMessageController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Ticket $ticket)
    {
        $this->authorize('getMessages', $ticket);

        $messages = $ticket->messages()->orderBy('created_at', 'desc')->get();

        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ticket $ticket)
    {
        $this->authorize('newMessage', $ticket);

        $validatedData = $request->validate([
            'content' => 'required|string',
            'is_system' => 'required|boolean',
        ]);

        $message = $ticket->messages()->create([
            'user_id' => request()->user()->id,
            'content' => $request->$validatedData['content'],
            'is_system' => $request->$validatedData['is_system'],
        ]);

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
