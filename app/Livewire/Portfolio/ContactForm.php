<?php

declare(strict_types=1);

namespace App\Livewire\Portfolio;

use App\Application\Contact\Actions\SendContactMessageAction;
use App\Application\Contact\DTOs\SendContactMessageDTO;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public string $extra_field_protection = '';

    public bool $submitted = false;

    public ?string $errorMessage = null;

    /**
     * Validation rules for the contact form.
     *
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    /**
     * Custom validation messages in Spanish.
     *
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Por favor indica tu nombre o el de tu empresa.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor ingresa un correo electrónico válido.',
            'subject.required' => 'El asunto es obligatorio.',
            'subject.min' => 'El asunto debe tener al menos 3 caracteres.',
            'message.required' => 'Por favor escribe un mensaje o propuesta.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
        ];
    }

    /**
     * Handle form submission.
     */
    public function submit(SendContactMessageAction $action): void
    {
        $this->errorMessage = null;

        // Anti-bot trap: If honeypot is filled, simulate success silently
        if (! empty(trim($this->extra_field_protection))) {
            $this->reset(['name', 'email', 'subject', 'message', 'extra_field_protection']);
            $this->submitted = true;

            return;
        }

        $this->validate();

        // Rate limit: max 5 messages per hour per IP
        $ip = request()->ip() ?: '127.0.0.1';
        $throttleKey = 'contact-form:'.$ip;

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = (int) ceil($seconds / 60);
            $this->errorMessage = "Has alcanzado el límite de envíos. Por favor espera {$minutes} minutos antes de volver a intentarlo.";

            return;
        }

        try {
            $action->execute(new SendContactMessageDTO(
                name: $this->name,
                email: $this->email,
                subject: $this->subject,
                message: $this->message,
                ipAddress: request()->ip(),
            ));

            RateLimiter::hit($throttleKey, 3600);

            $this->reset(['name', 'email', 'subject', 'message', 'extra_field_protection']);
            $this->submitted = true;
        } catch (\Throwable $e) {
            report($e);
            $this->errorMessage = 'No se pudo enviar el mensaje en este momento. Por favor intenta de nuevo o escribe directamente a alejandrocabezaoficial@gmail.com.';
        }
    }

    /**
     * Reset form state to allow sending another message.
     */
    public function resetForm(): void
    {
        $this->reset(['name', 'email', 'subject', 'message', 'extra_field_protection', 'errorMessage']);
        $this->submitted = false;
    }

    public function render(): View
    {
        return view('livewire.portfolio.contact-form');
    }
}
