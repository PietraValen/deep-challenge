<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class UserDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $password = null,
        public readonly ?UploadedFile $profile_image = null,
    ) {
    }

    public static function fromRequest(array $data, ?UploadedFile $file = null): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            profile_image: $file,
        );
    }
}
