<?php

declare(strict_types=1);

use App\Domain\Contact\ValueObjects\ContactMessage;
use App\Infrastructure\Mail\ContactInquiryMail;
use App\Infrastructure\Messaging\SendrixContactNotifier;
use Illuminate\Support\Facades\Mail;

test('sendrix contact notifier queues contact inquiry mail with correct details', function () {
    Mail::fake();

    config()->set('mail.contact_recipient', 'alejandrocabezaoficial@gmail.com');
    config()->set('mail.contact_mailer', 'sendrix');

    $notifier = new SendrixContactNotifier;

    $message = ContactMessage::create(
        name: 'Roberto Gómez',
        email: 'roberto@enterprise.com',
        subject: 'Consultoría de Infraestructura Docker',
        message: 'Hola Alejandro, necesitamos optimizar nuestros contenedores y CI/CD en producción.',
        ipAddress: '203.0.113.195',
    );

    $notifier->send($message);

    Mail::assertQueued(ContactInquiryMail::class, function (ContactInquiryMail $mail) {
        return $mail->hasTo('alejandrocabezaoficial@gmail.com')
            && $mail->senderName === 'Roberto Gómez'
            && $mail->senderEmail === 'roberto@enterprise.com'
            && $mail->subjectLine === 'Consultoría de Infraestructura Docker'
            && str_contains($mail->messageContent, 'optimizar nuestros contenedores')
            && $mail->ipAddress === '203.0.113.195';
    });
});
