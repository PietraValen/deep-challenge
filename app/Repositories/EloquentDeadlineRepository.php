<?php

namespace App\Repositories;

use App\Models\Deadline;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentDeadlineRepository
{
    public function getByUser(User $user): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $user->deadlines()->with('process')->orderBy('due_date')->paginate(10);
    }

    public function create(User $user, array $data): Deadline
    {
        return $user->deadlines()->create($data);
    }

    public function update(Deadline $deadline, array $data): bool
    {
        return $deadline->update($data);
    }

    public function delete(Deadline $deadline): bool
    {
        return $deadline->delete();
    }
}
