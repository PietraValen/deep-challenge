<?php

namespace App\Policies;

use App\Models\Deadline;
use App\Models\User;

class DeadlinePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Deadline $deadline): bool
    {
        return $user->id === $deadline->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Deadline $deadline): bool
    {
        return $user->id === $deadline->user_id;
    }

    public function delete(User $user, Deadline $deadline): bool
    {
        return $user->id === $deadline->user_id;
    }
}
