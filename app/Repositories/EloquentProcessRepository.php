<?php

namespace App\Repositories;

use App\Models\Process;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentProcessRepository
{
    public function getByUser(User $user): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $user->processes()->with('client')->latest()->paginate(10);
    }

    public function create(User $user, array $data): Process
    {
        return $user->processes()->create($data);
    }

    public function update(Process $process, array $data): bool
    {
        return $process->update($data);
    }

    public function delete(Process $process): bool
    {
        return $process->delete();
    }
}
