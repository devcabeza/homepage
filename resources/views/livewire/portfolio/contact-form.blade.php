<div class="w-full">
    @if ($submitted)
        <div class="p-6 sm:p-8 rounded-xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800/50 text-center space-y-4">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>

            <div class="space-y-1">
                <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white">
                    ¡Mensaje enviado con éxito!
                </h3>
                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 max-w-md mx-auto">
                    Gracias por ponerte en contacto. El mensaje ha sido despachado a mi correo personal vía Sendrix y te responderé en breve.
                </p>
            </div>

            <div class="pt-2">
                <x-button
                    type="button"
                    variant="outline"
                    size="sm"
                    wire:click="resetForm"
                    class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-mono text-xs"
                >
                    Enviar otro mensaje
                </x-button>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4 text-left" novalidate>
            {{-- Anti-bot honeypot trap --}}
            <x-honeypot name="extra_field_protection" wire:model="extra_field_protection" />

            @if ($errorMessage)
                <x-alert type="error" :dismissible="true">
                    {{ $errorMessage }}
                </x-alert>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Nombre --}}
                <x-input
                    name="name"
                    id="contact_name"
                    label="Nombre o Empresa *"
                    wire:model="name"
                    placeholder="Ej: Elon Musk / Tesla"
                    size="sm"
                    class="bg-white dark:bg-zinc-900/80 border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white placeholder:text-zinc-400"
                />

                {{-- Email --}}
                <x-input
                    name="email"
                    id="contact_email"
                    type="email"
                    label="Correo Electrónico *"
                    wire:model="email"
                    placeholder="tu.correo@empresa.com"
                    size="sm"
                    class="bg-white dark:bg-zinc-900/80 border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white placeholder:text-zinc-400"
                />
            </div>

            {{-- Asunto --}}
            <x-input
                name="subject"
                id="contact_subject"
                label="Asunto o Propuesta *"
                wire:model="subject"
                placeholder="Ej: Oportunidad Senior Backend / Consultoría TALL Stack"
                size="sm"
                class="bg-white dark:bg-zinc-900/80 border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white placeholder:text-zinc-400"
            />

            {{-- Mensaje --}}
            <x-textarea
                name="message"
                id="contact_message"
                label="Mensaje o Requerimientos *"
                wire:model="message"
                rows="4"
                placeholder="Cuéntame sobre el reto técnico, objetivos del equipo o detalles del proyecto..."
                class="bg-white dark:bg-zinc-900/80 border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white placeholder:text-zinc-400 text-sm"
            />

            {{-- Submit and gateway info --}}
            <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-[11px] font-mono text-zinc-500 order-2 sm:order-1">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Envío directo vía Sendrix Gateway</span>
                </div>

                <div class="order-1 sm:order-2">
                    <x-button
                        type="submit"
                        variant="primary"
                        size="sm"
                        wire:loading.attr="disabled"
                        wire:target="submit"
                        class="w-full sm:w-auto px-6 font-medium shadow-xs"
                    >
                        <span wire:loading.remove wire:target="submit" class="flex items-center gap-2">
                            <span>Enviar Mensaje</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </span>
                        <span wire:loading wire:target="submit" class="flex items-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                            <span>Enviando...</span>
                        </span>
                    </x-button>
                </div>
            </div>
        </form>
    @endif
</div>
