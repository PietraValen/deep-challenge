<?php

namespace App\Services;

use App\Actions\CreateDeadlineAction;
use App\Actions\UpdateDeadlineAction;
use App\DTOs\DeadlineDTO;
use App\Models\Deadline;
use App\Models\User;
use App\Repositories\EloquentDeadlineRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DeadlineService
{
    public function __construct(
        protected EloquentDeadlineRepository $repository,
        protected CreateDeadlineAction $createAction,
        protected UpdateDeadlineAction $updateAction,
    ) {
    }

    public function getUserDeadlines(User $user): LengthAwarePaginator
    {
        return $this->repository->getByUser($user);
    }

    public function createDeadline(User $user, DeadlineDTO $dto): Deadline
    {
        return $this->createAction->execute($user, $dto);
    }

    public function updateDeadline(Deadline $deadline, DeadlineDTO $dto): bool
    {
        return $this->updateAction->execute($deadline, $dto);
    }

    public function deleteDeadline(Deadline $deadline): bool
    {
        return $this->repository->delete($deadline);
    }
}
