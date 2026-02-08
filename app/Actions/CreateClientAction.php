<?php

namespace App\Actions;

use App\DTOs\ClientDTO;
use App\Models\Client;
use App\Models\User;
use App\Repositories\EloquentClientRepository;

class CreateClientAction
{
    public function __construct(protected EloquentClientRepository $repository)
    {
    }

    public function execute(User $user, ClientDTO $dto): Client
    {
        return $this->repository->create($user, [
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'document' => $dto->document,
            'address' => $dto->address,
            'notes' => $dto->notes,
        ]);
    }
}
