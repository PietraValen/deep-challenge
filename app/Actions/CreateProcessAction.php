<?php

namespace App\Actions;

use App\DTOs\ProcessDTO;
use App\Models\Process;
use App\Models\User;
use App\Repositories\EloquentProcessRepository;

class CreateProcessAction
{
    public function __construct(protected EloquentProcessRepository $repository)
    {
    }

    public function execute(User $user, ProcessDTO $dto): Process
    {
        return $this->repository->create($user, [
            'client_id' => $dto->client_id,
            'title' => $dto->title,
            'number' => $dto->number,
            'description' => $dto->description,
            'court' => $dto->court,
            'status' => $dto->status,
            'value' => $dto->value,
        ]);
    }
}
