<?php

namespace App\Actions;

use App\DTOs\DeadlineDTO;
use App\Models\Deadline;
use App\Repositories\EloquentDeadlineRepository;

class UpdateDeadlineAction
{
    public function __construct(protected EloquentDeadlineRepository $repository)
    {
    }

    public function execute(Deadline $deadline, DeadlineDTO $dto): bool
    {
        return $this->repository->update($deadline, array_filter([
            'process_id' => $dto->process_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->due_date,
            'status' => $dto->status,
        ], fn($value) => !is_null($value)));
    }
}
