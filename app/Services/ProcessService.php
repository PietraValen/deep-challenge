<?php

namespace App\Services;

use App\Actions\CreateProcessAction;
use App\Actions\UpdateProcessAction;
use App\DTOs\ProcessDTO;
use App\Models\Process;
use App\Models\User;
use App\Repositories\EloquentProcessRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProcessService
{
    public function __construct(
        protected EloquentProcessRepository $repository,
        protected CreateProcessAction $createAction,
        protected UpdateProcessAction $updateAction,
    ) {
    }

    public function getUserProcesses(User $user): LengthAwarePaginator
    {
        return $this->repository->getByUser($user);
    }

    public function createProcess(User $user, ProcessDTO $dto): Process
    {
        return $this->createAction->execute($user, $dto);
    }

    public function updateProcess(Process $process, ProcessDTO $dto): bool
    {
        return $this->updateAction->execute($process, $dto);
    }

    public function deleteProcess(Process $process): bool
    {
        return $this->repository->delete($process);
    }
}
