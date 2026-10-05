<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging;

use App\Domain\Contact\ValueObjects\ContactMessage;
use App\Infrastructure\Mail\ContactInquiryMail;
use App\Ports\Out\Messaging\ContactNotifierInterface;
use Illuminate\Support\Facades\Mail;

final class SendrixContactNotifier implements ContactNotifierInterface
{
    public function send(ContactMessage $message): void
    {
        $recipient = (string) config('mail.contact_recipient', 'alejandrocabezaoficial@gmail.com');
        $configuredMailer = (string) config('mail.contact_mailer', 'sendrix');

        // Deliver via the configured contact mailer (Sendrix transport)
        $mail = ! empty($configuredMailer)
            ? Mail::mailer($configuredMailer)
            : Mail::mailer(config('mail.default', 'sendrix'));

        $submittedAtFormatted = $message->submittedAt !== null
            ? $message->submittedAt->format('Y-m-d H:i:s T')
            : date('Y-m-d H:i:s T');

        $mail->to($recipient)->send(new ContactInquiryMail(
            senderName: $message->name,
            senderEmail: $message->email,
            subjectLine: $message->subject,
            messageContent: $message->message,
            ipAddress: $message->ipAddress,
            submittedAt: $submittedAtFormatted,
        ));
    }
}
