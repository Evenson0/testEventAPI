<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can create events.
     */
    public function create(User $user): bool
    {
        // Everyone can create events by default
        return true;
    }

    /**
     * Determine whether the user can update the given event.
     */
    public function update(User $user, Event $event): bool
    {
        // Only the creator can update
        return $user->id === $event->user_id;
    }
}
