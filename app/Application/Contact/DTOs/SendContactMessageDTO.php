<?php

declare(strict_types=1);

namespace App\Application\Contact\DTOs;

final readonly class SendContactMessageDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $subject,
        public string $message,
        public ?string $ipAddress = null,
    ) {}
}
