<?php

declare(strict_types=1);

namespace App\Domain\Contact\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;

final class ContactMessage
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $subject,
        public readonly string $message,
        public readonly ?string $ipAddress = null,
        public readonly ?DateTimeImmutable $submittedAt = null,
    ) {
        $trimmedName = trim($this->name);
        if ($trimmedName === '' || mb_strlen($trimmedName) < 2) {
            throw new InvalidArgumentException('El nombre del remitente debe tener al menos 2 caracteres.');
        }

        $trimmedEmail = trim($this->email);
        if (! filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("La dirección de correo electrónico '{$this->email}' no es válida.");
        }

        $trimmedSubject = trim($this->subject);
        if ($trimmedSubject === '' || mb_strlen($trimmedSubject) < 3) {
            throw new InvalidArgumentException('El asunto debe tener al menos 3 caracteres.');
        }

        $trimmedMessage = trim($this->message);
        if ($trimmedMessage === '' || mb_strlen($trimmedMessage) < 10) {
            throw new InvalidArgumentException('El contenido del mensaje debe tener al menos 10 caracteres.');
        }
    }

    public static function create(
        string $name,
        string $email,
        string $subject,
        string $message,
        ?string $ipAddress = null,
        ?DateTimeImmutable $submittedAt = null,
    ): self {
        return new self(
            name: trim($name),
            email: trim($email),
            subject: trim($subject),
            message: trim($message),
            ipAddress: $ipAddress ? trim($ipAddress) : null,
            submittedAt: $submittedAt ?? new DateTimeImmutable,
        );
    }
}
