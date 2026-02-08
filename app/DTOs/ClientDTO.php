<?php

namespace App\DTOs;

class ClientDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $document = null,
        public readonly ?string $address = null,
        public readonly ?string $notes = null,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            document: $data['document'] ?? null,
            address: $data['address'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }
}
