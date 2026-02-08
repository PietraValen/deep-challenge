<?php

namespace App\DTOs;

class ProcessDTO
{
    public function __construct(
        public readonly int $client_id,
        public readonly string $title,
        public readonly ?string $number = null,
        public readonly ?string $description = null,
        public readonly ?string $court = null,
        public readonly ?string $status = 'Em Andamento',
        public readonly ?float $value = null,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            client_id: (int) $data['client_id'],
            title: $data['title'],
            number: $data['number'] ?? null,
            description: $data['description'] ?? null,
            court: $data['court'] ?? null,
            status: $data['status'] ?? 'Em Andamento',
            value: isset($data['value']) ? (float) str_replace(['.', ','], ['', '.'], $data['value']) : null, // Handle currency format
        );
    }
}
