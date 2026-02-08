<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository
{
    public function create(array $attributes): User
    {
        return User::create($attributes);
    }

    public function update(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }
}
