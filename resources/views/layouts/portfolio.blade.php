<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Alejandro Cabeza — Proyectos Propios & MRR' }}</title>
        <meta name="description" content="{{ $description ?? 'Proyectos independientes, SaaS y herramientas desarrolladas por Alejandro Cabeza con métricas de ingresos (MRR) públicas y enlaces directos.' }}">

        <!-- Theme initialization script to prevent theme flash (FOUT) -->
        <script>
            (function () {
                const savedTheme = localStorage.getItem('portfolio_theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme ? savedTheme : (prefersDark ? 'dark' : 'dark');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            })();
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body
        class="min-h-screen bg-zinc-50 dark:bg-[#0c0d10] text-zinc-800 dark:text-zinc-200 antialiased font-sans touch-callout-none overflow-x-hidden selection:bg-zinc-200 dark:selection:bg-zinc-700 selection:text-zinc-900 dark:selection:text-white transition-colors duration-200"
        x-data="{
            copied: false,
            theme: localStorage.getItem('portfolio_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'dark'),
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('portfolio_theme', this.theme);
                if (this.theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            }
        }"
    >
        <div class="min-h-screen-safe w-full max-w-full overflow-x-hidden flex flex-col justify-between pb-safe">
            {{-- Unified Header with Navigation and Theme Switcher --}}
            <header class="w-full sticky top-0 z-40 bg-zinc-50/90 dark:bg-[#0c0d10]/90 backdrop-blur-md border-b border-zinc-200/80 dark:border-zinc-800/80 transition-colors pt-safe">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
                    {{-- Identity --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group shrink-0">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-emerald-500/20"></span>
                        <span class="font-bold text-sm sm:text-base text-zinc-900 dark:text-white group-hover:text-zinc-600 dark:group-hover:text-zinc-300 transition-colors">
                            Alejandro Cabeza
                        </span>
                        <span class="text-xs font-mono text-zinc-500 hidden sm:inline">&mdash; Senior Engineer</span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center gap-5 text-xs font-medium text-zinc-600 dark:text-zinc-400">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 font-semibold {{ request()->routeIs('projects.*') ? 'text-emerald-600 dark:text-emerald-400' : 'hover:text-zinc-900 dark:hover:text-white transition-colors' }}">
                            <span>Proyectos & MRR</span>
                            <span class="text-[10px] font-mono opacity-80">↗</span>
                        </a>
                    </nav>

                    {{-- Actions: Theme Toggle & CV Download --}}
                    <div class="flex items-center gap-2">
                        {{-- Light / Dark Theme Switcher --}}
                        <button
                            type="button"
                            @click="toggleTheme()"
                            class="p-2 rounded-lg border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/60 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer"
                            :title="theme === 'dark' ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
                            aria-label="Alternar tema claro y oscuro"
                        >
                            {{-- Sun Icon (shown in dark mode) --}}
                            <svg x-show="theme === 'dark'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{-- Moon Icon (shown in light mode) --}}
                            <svg x-show="theme === 'light'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>

                        <x-button
                            href="{{ route('cv.download') }}"
                            target="_blank"
                            download="CV_Alejandro_Cabeza.pdf"
                            variant="outline"
                            size="xs"
                            class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900/60 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-mono text-xs px-2.5 sm:px-3 min-h-[34px] inline-flex items-center gap-1.5"
                            title="Descargar Curriculum Vitae en PDF"
                        >
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <span>CV (PDF)</span>
                        </x-button>

                        <x-button
                            variant="outline"
                            size="xs"
                            @click="navigator.clipboard.writeText('alejandrocabezaoficial@gmail.com'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900/60 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-mono text-xs px-3 min-h-[34px] hidden sm:inline-flex"
                            title="Copiar email"
                        >
                            <span x-text="copied ? '¡Copiado!' : 'Copiar Email'"></span>
                        </x-button>
                    </div>
                </div>
            </header>

            {{-- Main Content Canvas --}}
            <main class="flex-1 w-full">
                {{ $slot }}
            </main>

            {{-- Minimalist Footer --}}
            <footer class="w-full border-t border-zinc-200 dark:border-zinc-800/80 py-8 px-4 text-center text-xs font-mono text-zinc-500 space-y-1">
                <div>
                    ALEJANDRO CABEZA &copy; {{ date('Y') }} &middot; Senior Software Engineer & TALL Stack Specialist
                </div>
                <div class="text-[11px] text-zinc-400 dark:text-zinc-600">
                    Laravel 13 &middot; Livewire 4 &middot; Tailwind CSS v4 &middot; DaisyUI 5 &middot; Docker
                </div>
            </footer>
        </div>

        @livewireScripts
    </body>
</html>
