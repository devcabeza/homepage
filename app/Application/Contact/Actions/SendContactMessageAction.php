<?php

declare(strict_types=1);

namespace App\Application\Contact\Actions;

use App\Application\Contact\DTOs\SendContactMessageDTO;
use App\Domain\Contact\ValueObjects\ContactMessage;
use App\Ports\Out\Messaging\ContactNotifierInterface;
use DateTimeImmutable;

final class SendContactMessageAction
{
    public function __construct(
        private readonly ContactNotifierInterface $notifier,
    ) {}

    public function execute(SendContactMessageDTO $dto): void
    {
        $contactMessage = ContactMessage::create(
            name: $dto->name,
            email: $dto->email,
            subject: $dto->subject,
            message: $dto->message,
            ipAddress: $dto->ipAddress,
            submittedAt: new DateTimeImmutable,
        );

        $this->notifier->send($contactMessage);
    }
}
