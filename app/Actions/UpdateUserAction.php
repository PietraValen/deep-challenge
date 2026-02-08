<?php

namespace App\Actions;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateUserAction
{
    public function __construct(protected EloquentUserRepository $userRepository)
    {
    }

    public function execute(User $user, UserDTO $dto): bool
    {
        $attributes = [];

        if ($dto->name) {
            $attributes['name'] = $dto->name;
        }

        if ($dto->email) {
            $attributes['email'] = $dto->email;
        }

        if ($dto->password) {
            $attributes['password'] = Hash::make($dto->password);
        }

        if ($dto->profile_image) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $attributes['profile_image'] = $dto->profile_image->store('profiles', 'public');
        }

        return $this->userRepository->update($user, $attributes);
    }
}
