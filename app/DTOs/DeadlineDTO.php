<?php

namespace App\DTOs;

use Carbon\Carbon;

class DeadlineDTO
{
    public function __construct(
        public readonly string $title,
        public readonly \DateTimeInterface $due_date,
        public readonly ?int $process_id = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'Pendente',
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'],
            due_date: Carbon::parse($data['due_date']),
            process_id: !empty($data['process_id']) ? (int) $data['process_id'] : null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'Pendente',
        );
    }
}
