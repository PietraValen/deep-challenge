<?php

namespace App\Actions;

use App\DTOs\ProcessDTO;
use App\Models\Process;
use App\Repositories\EloquentProcessRepository;

class UpdateProcessAction
{
    public function __construct(protected EloquentProcessRepository $repository)
    {
    }

    public function execute(Process $process, ProcessDTO $dto): bool
    {
        return $this->repository->update($process, array_filter([
            'client_id' => $dto->client_id,
            'title' => $dto->title,
            'number' => $dto->number,
            'description' => $dto->description,
            'court' => $dto->court,
            'status' => $dto->status,
            'value' => $dto->value,
        ], fn($value) => !is_null($value)));
    }
}
