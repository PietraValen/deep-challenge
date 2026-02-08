<?php

namespace App\Services;

use App\Actions\CreateUserAction;
use App\Actions\UpdateUserAction;
use App\DTOs\UserDTO;
use App\Models\User;

class UserService
{
    public function __construct(
        protected CreateUserAction $createUserAction,
        protected UpdateUserAction $updateUserAction
    ) {
    }

    public function createUser(UserDTO $dto): User
    {
        return $this->createUserAction->execute($dto);
    }

    public function updateUser(User $user, UserDTO $dto): bool
    {
        return $this->updateUserAction->execute($user, $dto);
    }
}
