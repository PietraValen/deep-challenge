<?php

namespace App\Policies;

use App\Models\Process;
use App\Models\User;

class ProcessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Process $process): bool
    {
        return $user->id === $process->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Process $process): bool
    {
        return $user->id === $process->user_id;
    }

    public function delete(User $user, Process $process): bool
    {
        return $user->id === $process->user_id;
    }
}
