<?php

declare(strict_types=1);

use App\Infrastructure\Mail\ContactInquiryMail;
use App\Livewire\Portfolio\ContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;

beforeEach(function () {
    RateLimiter::clear('contact-form:127.0.0.1');
});

test('contact form renders successfully with all required inputs and sendrix branding', function () {
    Livewire::test(ContactForm::class)
        ->assertOk()
        ->assertSee('Nombre o Empresa')
        ->assertSee('Correo Electrónico')
        ->assertSee('Asunto o Propuesta')
        ->assertSee('Mensaje o Requerimientos')
        ->assertSee('Enviar Mensaje')
        ->assertSee('Sendrix Gateway');
});

test('validates required fields on contact form', function () {
    Livewire::test(ContactForm::class)
        ->set('name', '')
        ->set('email', '')
        ->set('subject', '')
        ->set('message', '')
        ->call('submit')
        ->assertHasErrors([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
});

test('validates field length and format rules', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'A')
        ->set('email', 'not-a-valid-email')
        ->set('subject', 'Hi')
        ->set('message', 'Short')
        ->call('submit')
        ->assertHasErrors([
            'name' => 'min',
            'email' => 'email',
            'subject' => 'min',
            'message' => 'min',
        ]);
});

test('successfully sends contact inquiry email via sendrix and updates UI to success state', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('name', 'Ana Morales')
        ->set('email', 'ana.morales@globaltech.com')
        ->set('subject', 'Oportunidad Senior Backend Engineer')
        ->set('message', 'Hola Alejandro, nos ha impresionado tu experiencia en TALL stack y arquitectura hexagonal.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true)
        ->assertSee('¡Mensaje enviado con éxito!')
        ->assertSee('Enviar otro mensaje');

    Mail::assertQueued(ContactInquiryMail::class, function (ContactInquiryMail $mail) {
        return $mail->hasTo('alejandrocabezaoficial@gmail.com')
            && $mail->hasReplyTo('ana.morales@globaltech.com', 'Ana Morales')
            && $mail->senderName === 'Ana Morales'
            && $mail->senderEmail === 'ana.morales@globaltech.com'
            && $mail->subjectLine === 'Oportunidad Senior Backend Engineer'
            && str_contains($mail->messageContent, 'arquitectura hexagonal');
    });
});

test('silently ignores spam bots when honeypot field is filled', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('extra_field_protection', 'I am a spam bot')
        ->set('name', 'Bot spammer')
        ->set('email', 'bot@spammer.org')
        ->set('subject', 'Cheap SEO services')
        ->set('message', 'Click this link to buy backlinks now and forever.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);

    Mail::assertNothingQueued();
});

test('enforces rate limiting after 5 consecutive attempts', function () {
    Mail::fake();

    $component = Livewire::test(ContactForm::class);

    // 5 attempts allowed
    for ($i = 1; $i <= 5; $i++) {
        $component->set('name', "Sender {$i}")
            ->set('email', "sender{$i}@example.com")
            ->set('subject', "Asunto válido {$i}")
            ->set('message', "Este es un mensaje válido número {$i} para la prueba.")
            ->call('submit')
            ->assertHasNoErrors()
            ->call('resetForm');
    }

    Mail::assertQueued(ContactInquiryMail::class, 5);

    // 6th attempt should be rate limited
    $component->set('name', 'Sender 6')
        ->set('email', 'sender6@example.com')
        ->set('subject', 'Asunto válido 6')
        ->set('message', 'Este es un mensaje que debería ser rechazado por límite.')
        ->call('submit')
        ->assertSet('submitted', false)
        ->assertSee('Has alcanzado el límite de envíos');

    // Still only 5 queued emails
    Mail::assertQueued(ContactInquiryMail::class, 5);
});

test('can reset form after successful submission to send another message', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('name', 'David Silva')
        ->set('email', 'david@consulting.io')
        ->set('subject', 'Consulta Arquitectura')
        ->set('message', 'Estimado Alejandro, queremos consultar sobre refactorización a Clean Architecture.')
        ->call('submit')
        ->assertSet('submitted', true)
        ->call('resetForm')
        ->assertSet('submitted', false)
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('subject', '')
        ->assertSet('message', '')
        ->assertSee('Enviar Mensaje');
});
