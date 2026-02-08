<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentClientRepository
{
    public function getByUser(User $user): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $user->clients()->latest()->paginate(10);
    }

    public function create(User $user, array $data): Client
    {
        return $user->clients()->create($data);
    }

    public function update(Client $client, array $data): bool
    {
        return $client->update($data);
    }

    public function delete(Client $client): bool
    {
        return $client->delete();
    }
}
