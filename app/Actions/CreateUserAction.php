<?php

namespace App\Actions;

use App\DTOs\UserDTO;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUserAction
{
    public function __construct(protected EloquentUserRepository $userRepository)
    {
    }

    public function execute(UserDTO $dto): User
    {
        $attributes = [
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ];

        return $this->userRepository->create($attributes);
    }
}
