<?php

namespace App\Actions;

use App\DTOs\ClientDTO;
use App\Models\Client;
use App\Repositories\EloquentClientRepository;

class UpdateClientAction
{
    public function __construct(protected EloquentClientRepository $repository)
    {
    }

    public function execute(Client $client, ClientDTO $dto): bool
    {
        return $this->repository->update($client, array_filter([
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'document' => $dto->document,
            'address' => $dto->address,
            'notes' => $dto->notes,
        ], fn($value) => !is_null($value)));
    }
}
