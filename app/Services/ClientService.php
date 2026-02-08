<?php

namespace App\Services;

use App\Actions\CreateClientAction;
use App\Actions\UpdateClientAction;
use App\DTOs\ClientDTO;
use App\Models\Client;
use App\Models\User;
use App\Repositories\EloquentClientRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientService
{
    public function __construct(
        protected EloquentClientRepository $repository,
        protected CreateClientAction $createAction,
        protected UpdateClientAction $updateAction,
    ) {
    }

    public function getUserClients(User $user): LengthAwarePaginator
    {
        return $this->repository->getByUser($user);
    }

    public function createClient(User $user, ClientDTO $dto): Client
    {
        return $this->createAction->execute($user, $dto);
    }

    public function updateClient(Client $client, ClientDTO $dto): bool
    {
        return $this->updateAction->execute($client, $dto);
    }

    public function deleteClient(Client $client): bool
    {
        return $this->repository->delete($client);
    }
}
