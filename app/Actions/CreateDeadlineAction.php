<?php

namespace App\Actions;

use App\DTOs\DeadlineDTO;
use App\Models\Deadline;
use App\Models\User;
use App\Repositories\EloquentDeadlineRepository;

class CreateDeadlineAction
{
    public function __construct(protected EloquentDeadlineRepository $repository)
    {
    }

    public function execute(User $user, DeadlineDTO $dto): Deadline
    {
        return $this->repository->create($user, [
            'process_id' => $dto->process_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->due_date,
            'status' => $dto->status,
        ]);
    }
}
