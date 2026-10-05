<?php

declare(strict_types=1);

use App\Domain\Contact\ValueObjects\ContactMessage;

test('creates valid contact message value object', function () {
    $now = new DateTimeImmutable('2026-10-04 12:00:00');
    $message = ContactMessage::create(
        name: 'Carlos Mendoza',
        email: 'carlos@techcorp.io',
        subject: 'Propuesta Proyecto Backend',
        message: 'Hola Alejandro, nos interesa tu perfil para liderar la arquitectura de nuestra plataforma.',
        ipAddress: '192.168.1.10',
        submittedAt: $now,
    );

    expect($message->name)->toBe('Carlos Mendoza')
        ->and($message->email)->toBe('carlos@techcorp.io')
        ->and($message->subject)->toBe('Propuesta Proyecto Backend')
        ->and($message->message)->toContain('nos interesa tu perfil')
        ->and($message->ipAddress)->toBe('192.168.1.10')
        ->and($message->submittedAt)->toBe($now);
});

test('throws exception when name is too short', function () {
    expect(fn () => ContactMessage::create(
        name: 'A',
        email: 'test@example.com',
        subject: 'Asunto de prueba',
        message: 'Mensaje de prueba con más de 10 caracteres',
    ))->toThrow(InvalidArgumentException::class, 'al menos 2 caracteres');
});

test('throws exception when email is invalid', function () {
    expect(fn () => ContactMessage::create(
        name: 'Carlos Mendoza',
        email: 'invalid-email-format',
        subject: 'Asunto de prueba',
        message: 'Mensaje de prueba con más de 10 caracteres',
    ))->toThrow(InvalidArgumentException::class, 'no es válida');
});

test('throws exception when subject is too short', function () {
    expect(fn () => ContactMessage::create(
        name: 'Carlos Mendoza',
        email: 'carlos@example.com',
        subject: 'No',
        message: 'Mensaje de prueba con más de 10 caracteres',
    ))->toThrow(InvalidArgumentException::class, 'al menos 3 caracteres');
});

test('throws exception when message is too short', function () {
    expect(fn () => ContactMessage::create(
        name: 'Carlos Mendoza',
        email: 'carlos@example.com',
        subject: 'Asunto válido',
        message: 'Corto',
    ))->toThrow(InvalidArgumentException::class, 'al menos 10 caracteres');
});
