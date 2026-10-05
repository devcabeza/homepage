<?php

declare(strict_types=1);

use App\Application\Contact\Actions\SendContactMessageAction;
use App\Application\Contact\DTOs\SendContactMessageDTO;
use App\Domain\Contact\ValueObjects\ContactMessage;
use App\Ports\Out\Messaging\ContactNotifierInterface;

test('successfully sends contact message through notifier port', function () {
    $notifier = Mockery::mock(ContactNotifierInterface::class);
    $notifier->shouldReceive('send')
        ->once()
        ->withArgs(function (ContactMessage $message) {
            return $message->name === 'Elena Rodriguez'
                && $message->email === 'elena@startup.es'
                && $message->subject === 'Colaboración Técnica'
                && $message->message === 'Hola Alejandro, nos gustaría coordinar una llamada técnica.'
                && $message->ipAddress === '10.0.0.1';
        });

    $action = new SendContactMessageAction($notifier);

    $dto = new SendContactMessageDTO(
        name: 'Elena Rodriguez',
        email: 'elena@startup.es',
        subject: 'Colaboración Técnica',
        message: 'Hola Alejandro, nos gustaría coordinar una llamada técnica.',
        ipAddress: '10.0.0.1',
    );

    $action->execute($dto);
});
