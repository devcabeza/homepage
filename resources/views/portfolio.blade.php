<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Alejandro Cabeza — Senior Software Engineer & TALL Stack Specialist | Backend to DevOps</title>
        <meta name="description" content="Portfolio profesional de Alejandro Cabeza. Senior Software Engineer & TALL Stack Specialist en transición activa de Backend a DevOps, especialista en arquitecturas robustas y pipelines de CI/CD.">

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
            {{-- Minimalist Header with Navigation and Theme Switcher --}}
            <header class="w-full sticky top-0 z-40 bg-zinc-50/90 dark:bg-[#0c0d10]/90 backdrop-blur-md border-b border-zinc-200/80 dark:border-zinc-800/80 transition-colors pt-safe">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
                    {{-- Identity --}}
                    <a href="#hero" class="flex items-center gap-2.5 group shrink-0">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-emerald-500/20"></span>
                        <span class="font-bold text-sm sm:text-base text-zinc-900 dark:text-white group-hover:text-zinc-600 dark:group-hover:text-zinc-300 transition-colors">
                            Alejandro Cabeza
                        </span>
                        <span class="text-xs font-mono text-zinc-500 hidden sm:inline">&mdash; Senior Engineer</span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center gap-5 text-xs font-medium text-zinc-600 dark:text-zinc-400">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 hover:text-zinc-900 dark:hover:text-white transition-colors">
                            <span>Proyectos & MRR</span>
                            <span class="text-[10px] font-mono opacity-80">↗</span>
                        </a>
                    </nav>

                    {{-- Actions: Theme Toggle & Email Copy --}}
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
            <main class="flex-1 w-full max-w-4xl mx-auto px-4 sm:px-6 py-12 sm:py-16 space-y-20">

                {{-- 1. HERO: Saludo Cordial a Recruiters + Presentación Corta + Métricas Clave --}}
                <section id="hero" class="space-y-6 pt-2">
                    {{-- Saludo cordial discreto --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs font-medium shadow-2xs">
                        <span>👋</span>
                        <span>Hola, un cordial saludo tanto a recruiters como a líderes técnicos y colegas.</span>
                    </div>

                    {{-- Nombre y Título --}}
                    <div class="space-y-2">
                        <h1 class="text-3xl sm:text-5xl font-extrabold text-zinc-900 dark:text-white tracking-tight leading-tight">
                            Alejandro Cabeza
                        </h1>
                        <p class="text-base sm:text-lg font-mono text-zinc-600 dark:text-zinc-400">
                            Senior Software Engineer & TALL Stack Specialist &middot; Transición a DevOps
                        </p>
                    </div>

                    {{-- Bio corta y directa --}}
                    <p class="text-sm sm:text-base text-zinc-700 dark:text-zinc-300 leading-relaxed max-w-2xl">
                        Especialista en el ecosistema <strong class="text-zinc-900 dark:text-white font-medium">TALL (Tailwind · Alpine · Livewire · Laravel)</strong> con más de 5 años diseñando soluciones escalables, optimizando servidores hasta en un <span class="text-zinc-900 dark:text-white font-medium">-90% de latencia</span> y orquestando pipelines de <span class="text-zinc-900 dark:text-white font-medium">CI/CD y contenedores Docker</span> para despliegues de alta disponibilidad sin interrupciones.
                    </p>

                    {{-- Métricas Clave Minimalistas --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3.5 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors">
                            <div class="text-xl font-bold font-mono text-zinc-900 dark:text-white">+5 Años</div>
                            <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Ecosistema Laravel & TALL</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors">
                            <div class="text-xl font-bold font-mono text-zinc-900 dark:text-white">-90% Latencia</div>
                            <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Optimización Backend (Prefexya)</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors">
                            <div class="text-xl font-bold font-mono text-zinc-900 dark:text-white">-70% Tiempo</div>
                            <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Automatización de Órdenes</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors">
                            <div class="text-xl font-bold font-mono text-zinc-900 dark:text-white">100% CI/CD</div>
                            <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Infraestructura & Docker</div>
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <x-button
                            href="{{ route('cv.download') }}"
                            target="_blank"
                            download="CV_Alejandro_Cabeza.pdf"
                            variant="primary"
                            size="sm"
                            class="font-medium shadow-xs inline-flex items-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <span>Descargar CV (PDF)</span>
                        </x-button>

                        <x-button href="#experiencia" variant="outline" size="sm" class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-medium">
                            Ver Trayectoria ↓
                        </x-button>

                        <x-button
                            href="{{ route('projects.index') }}"
                            variant="outline"
                            size="sm"
                            class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-medium inline-flex items-center gap-1.5"
                        >
                            <span>Proyectos & MRR</span>
                            <span class="text-xs font-mono">↗</span>
                        </x-button>

                        <a href="mailto:alejandrocabezaoficial@gmail.com" class="text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors underline underline-offset-4 ml-1">
                            alejandrocabezaoficial@gmail.com
                        </a>
                    </div>
                </section>

                {{-- 2. EXPERIENCIA: Línea de Tiempo Profesional --}}
                <section id="experiencia" class="space-y-6 scroll-mt-20">
                    <div class="border-b border-zinc-200 dark:border-zinc-800/80 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Historial Laboral</span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight mt-1">
                            Experiencia Laboral
                        </h2>
                    </div>

                    <div class="space-y-8 pl-1">
                        {{-- 1. Aludespagroup --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-emerald-500/20"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    Aludespagroup <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; Senior Full-Stack Engineer & DevOps</span>
                                </h3>
                                <span class="text-xs font-mono text-emerald-600 dark:text-emerald-400 font-medium">Marzo 2026 – Presente</span>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; Liderazgo técnico en el desarrollo de productos end-to-end con Laravel 12 y Livewire 3.</li>
                                <li>&bull; Diseño y automatización integral de pipelines de CI/CD e infraestructura cloud, garantizando alta disponibilidad, seguridad y despliegues sin interrupciones.</li>
                            </ul>
                        </div>

                        {{-- 2. WallsTeam --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    WallsTeam <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; Senior Full-Stack Engineer</span>
                                </h3>
                                <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">Enero 2024 – Febrero 2026</span>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; Liderazgo en el desarrollo de soluciones empresariales de alto rendimiento, destacando plataformas críticas como Fairpay y Gotitjob.</li>
                                <li>&bull; Implementación de arquitecturas modernas y sistemas orientados a eventos, reduciendo sustancialmente los tiempos de respuesta del servidor y la latencia.</li>
                            </ul>
                        </div>

                        {{-- 3. AthenadeXFi --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    AthenadeXFi <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; Backend Team Lead & DevOps Engineer</span>
                                </h3>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; <strong>MioCondo:</strong> Liderazgo técnico integral en el diseño arquitectónico, desarrollo backend y despliegue en producción de un sistema para la gestión integral de condominios y propiedades.</li>
                                <li>&bull; <strong>DeFi & Web3 Infrastructure:</strong> Implementación de cultura DevOps, hardening de servidores y pipelines de integración/despliegue continuo (CI/CD) para protocolos DeFi.</li>
                                <li>&bull; Coordinación y mentoría técnica del equipo backend, garantizando estándares de calidad de código, pruebas y arquitectura limpia.</li>
                            </ul>
                        </div>

                        {{-- 4. Genius Hormo --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    Genius Hormo (USA) <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; WordPress Developer</span>
                                </h3>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; Desarrollo e integración de soluciones a medida sobre WordPress, diseñando un middleware reactivo para la orquestación e integración de órdenes médicas.</li>
                                <li>&bull; Automatización del 100% del flujo operativo de órdenes, reduciendo los tiempos de procesamiento en un 70% y asegurando la integridad de los datos.</li>
                            </ul>
                        </div>

                        {{-- 5. Prefexya --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    Prefexya <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; Senior Backend Developer</span>
                                </h3>
                                <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">Junio 2022 – Diciembre 2023</span>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; Reducción del 90% en tiempos de respuesta del sistema e incremento del 70% en el engagement e interacción de usuarios.</li>
                                <li>&bull; Desarrollo de integraciones complejas con APIs externas (Zoho CRM/Suite) sobre Symfony y MySQL.</li>
                                <li>&bull; Estandarización de entornos locales y de producción mediante Docker.</li>
                            </ul>
                        </div>

                        {{-- 6. SEO Contenidos --}}
                        <div class="relative pl-6 border-l border-zinc-200 dark:border-zinc-800 space-y-2">
                            <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></div>
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                    SEO Contenidos <span class="font-normal text-zinc-500 dark:text-zinc-400 font-mono text-xs">&mdash; Full Stack Developer</span>
                                </h3>
                                <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">Enero 2021 – Mayo 2022</span>
                            </div>
                            <ul class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 space-y-1.5 leading-relaxed">
                                <li>&bull; Reingeniería integral de la plataforma de <strong>Empresas Polar</strong>, desarrollando módulos a medida en TypeScript, Node.js y PHP.</li>
                                <li>&bull; Optimización de integraciones y soporte para arquitecturas de alto tráfico y demanda.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                {{-- 3. SOBRE MÍ: Descripción en Profundidad & Filosofía de Ingeniería --}}
                <section id="sobre-mi" class="space-y-8 scroll-mt-20">
                    <div class="border-b border-zinc-200 dark:border-zinc-800/80 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Perfil & Enfoque</span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight mt-1">
                            Sobre Mí & Filosofía de Ingeniería
                        </h2>
                    </div>

                    {{-- Texto descriptivo personal --}}
                    <div class="space-y-4 text-sm sm:text-base text-zinc-700 dark:text-zinc-300 leading-relaxed">
                        <p>
                            A lo largo de más de 5 años en la industria del software, me he especializado en diseñar y desplegar arquitecturas robustas que resuelven problemas de negocio reales sin añadir complejidad innecesaria. Mi enfoque se basa en la simplicidad, la mantenibilidad a largo plazo y la rigurosidad técnica.
                        </p>
                        <p>
                            Aplico principios <strong class="text-zinc-900 dark:text-white font-semibold">SOLID</strong>, <strong class="text-zinc-900 dark:text-white font-semibold">Domain-Driven Design (DDD)</strong> y patrones como la <strong class="text-zinc-900 dark:text-white font-semibold">Arquitectura Hexagonal</strong> para desacoplar el dominio de la infraestructura. Esto asegura que la lógica crítica permanezca protegida, testeable y lista para escalar.
                        </p>
                        <p>
                            Mi transición hacia <strong class="text-zinc-900 dark:text-white font-semibold">DevOps</strong> es el resultado natural de entender que la ingeniería de software no termina en el código, sino en cómo ese código se entrega, monitorea y mantiene en producción: entornos reproducibles con Docker, suites de pruebas con Pest y pipelines automatizados de CI/CD para lograr cero tiempo de inactividad.
                        </p>
                    </div>

                    {{-- Áreas de Conocimiento --}}
                    <div id="areas" class="space-y-4 pt-2">
                        <h3 class="text-sm font-mono uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Áreas de Conocimiento & Especialización
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1.5">
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Ecosistema Laravel & Stack TALL</h4>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    Más de 5 años diseñando y desplegando aplicaciones backend y full-stack robustas, reactivas y de alto impacto, centralizando la lógica en el servidor para maximizar la seguridad y mantenibilidad.
                                </p>
                            </div>

                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1.5">
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Liderazgo Técnico & Arquitectura</h4>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    Experiencia liderando equipos backend y orquestando ciclos de vida completos de software; especialista en Domain-Driven Design (DDD), Event-Driven Architecture, principios SOLID y soluciones modulares.
                                </p>
                            </div>

                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1.5">
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Infraestructura, DevOps & Cloud</h4>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    Experiencia práctica en automatización de despliegues (CI/CD), contenedores con Docker, optimización de servidores e implementación de entornos de alta disponibilidad.
                                </p>
                            </div>

                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1.5">
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Desarrollo de Herramientas & Ecosistema</h4>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    Creador de paquetes y herramientas para desarrolladores orientadas a la optimización de flujos de trabajo, automatización y productividad técnica (Sendrix, LaraVertex, Fillr).
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Transición Técnica Pipeline --}}
                    <div id="pipeline" class="space-y-4 pt-2">
                        <div class="space-y-1">
                            <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Transición Técnica</span>
                            <h3 class="text-base font-bold text-zinc-900 dark:text-white">
                                De la Lógica de Negocio a la Entrega Continua Resiliente
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">
                            <div class="p-3 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-1">
                                <div class="text-xs font-mono text-zinc-500">01</div>
                                <div class="text-xs font-bold text-zinc-900 dark:text-white">Dominio & SOLID</div>
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-400">DDD y Clean Code.</p>
                            </div>

                            <div class="p-3 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-1">
                                <div class="text-xs font-mono text-zinc-500">02</div>
                                <div class="text-xs font-bold text-zinc-900 dark:text-white">Calidad & Pruebas</div>
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-400">Pest Architecture.</p>
                            </div>

                            <div class="p-3 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-1">
                                <div class="text-xs font-mono text-zinc-500">03</div>
                                <div class="text-xs font-bold text-zinc-900 dark:text-white">Contenedores Docker</div>
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-400">Linux & hardening.</p>
                            </div>

                            <div class="p-3 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-1">
                                <div class="text-xs font-mono text-zinc-500">04</div>
                                <div class="text-xs font-bold text-zinc-900 dark:text-white">Pipelines CI/CD</div>
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-400">GitHub Actions.</p>
                            </div>

                            <div class="p-3 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-1">
                                <div class="text-xs font-mono text-zinc-500">05</div>
                                <div class="text-xs font-bold text-zinc-900 dark:text-white">Alta Disponibilidad</div>
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-400">Redis & Observabilidad.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 4. ESTUDIOS: Formación Académica Acreditada --}}
                <section id="estudios" class="space-y-6 scroll-mt-20">
                    <div class="border-b border-zinc-200 dark:border-zinc-800/80 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Formación Académica</span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight mt-1">
                            Estudios & Titulación
                        </h2>
                    </div>

                    <div id="educacion" class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-bold text-zinc-900 dark:text-white">Ingeniería en Informática</h4>
                                    <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">Prevista: Finales de 2026</span>
                                </div>
                                <p class="text-xs font-mono text-zinc-500">IUPTAI</p>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400">Formación universitaria superior en ciencias de la computación, arquitectura de software e ingeniería de sistemas.</p>
                            </div>

                            <div class="p-4 rounded-lg bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-bold text-zinc-900 dark:text-white">TSU en Informática</h4>
                                    <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">Graduado, 2024</span>
                                </div>
                                <p class="text-xs font-mono text-zinc-500">IUPTAI</p>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400">Titulación técnica universitaria especializada en análisis, desarrollo y bases de datos.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 5. CONTACTO: Cierre Minimalista y Formulario Sendrix --}}
                <section id="contacto" class="p-6 sm:p-8 rounded-xl bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-6 scroll-mt-20">
                    <div class="text-center space-y-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Contacto Directo</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">
                            ¿Hablamos de Arquitectura o Despliegues?
                        </h2>
                        <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 max-w-md mx-auto">
                            Abierto a nuevos retos técnicos como Senior Software Engineer, líder de backend o ingeniero de infraestructura/DevOps.
                        </p>

                        <div class="pt-1 flex flex-wrap items-center justify-center gap-3">
                            <x-button
                                href="{{ route('cv.download') }}"
                                target="_blank"
                                download="CV_Alejandro_Cabeza.pdf"
                                variant="outline"
                                size="sm"
                                class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-mono text-xs px-4 inline-flex items-center gap-2"
                            >
                                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>Descargar CV</span>
                            </x-button>

                            <x-button
                                href="mailto:alejandrocabezaoficial@gmail.com"
                                variant="primary"
                                size="sm"
                                class="px-5 font-medium shadow-xs"
                            >
                                alejandrocabezaoficial@gmail.com
                            </x-button>

                            <x-button
                                variant="outline"
                                size="sm"
                                @click="navigator.clipboard.writeText('alejandrocabezaoficial@gmail.com'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 font-mono text-xs px-4"
                            >
                                <span x-text="copied ? '¡Copiado!' : 'Copiar Email'"></span>
                            </x-button>
                        </div>
                    </div>

                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-zinc-200 dark:border-zinc-800/80"></div>
                        </div>
                        <div class="relative flex justify-center text-xs font-mono uppercase">
                            <span class="bg-white dark:bg-[#13141b] px-3 text-zinc-400 dark:text-zinc-500">
                                O envíame un mensaje directo desde aquí
                            </span>
                        </div>
                    </div>

                    <livewire:portfolio.contact-form />
                </section>
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
