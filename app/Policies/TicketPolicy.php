<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->id == $ticket->tenant()->id || $user->id === $ticket->owner()->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Property $property): bool
    {
        return $user->id === $property->owner->id || $user->id === $property->tenant->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->owner()->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return false;
    }

    public function getMessages(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->owner()->id || $user->id === $ticket->tenant()->id;
    }

    public function newMessage(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->owner()->id || $user->id === $ticket->tenant->id;
    }
}
