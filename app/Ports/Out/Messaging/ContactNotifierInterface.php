<?php

declare(strict_types=1);

namespace App\Ports\Out\Messaging;

use App\Domain\Contact\ValueObjects\ContactMessage;

interface ContactNotifierInterface
{
    /**
     * Send a contact message notification to the website administrator.
     */
    public function send(ContactMessage $message): void;
}
