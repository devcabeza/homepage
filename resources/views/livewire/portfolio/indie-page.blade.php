<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
        {{-- Left Sticky Sidebar: Indie Hacker Profile & Aggregate MRR --}}
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start">
            {{-- Profile Card --}}
            <div class="p-6 rounded-2xl bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs space-y-5">
                <div class="flex items-center gap-4">
                    <div class="relative shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 via-zinc-800 to-indigo-600 p-[2px] shadow-sm">
                            <div class="w-full h-full rounded-2xl bg-zinc-900 flex items-center justify-center text-white font-extrabold text-xl tracking-tight font-mono">
                                AC
                            </div>
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white dark:border-[#13141b]" title="Activo y construyendo"></span>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-zinc-900 dark:text-white tracking-tight">
                            Alejandro Cabeza
                        </h1>
                        <p class="text-xs font-mono text-zinc-500 dark:text-zinc-400 mt-0.5">
                            Indie Hacker & Software Architect
                        </p>
                        <div class="inline-flex items-center gap-1.5 text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 font-mono">
                            <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Valencia, VE &middot; Remoto</span>
                        </div>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed">
                    Construyendo herramientas de software de alta calidad, plataformas transaccionales resilientes y productos independientes para el ecosistema moderno.
                </p>

                {{-- Signature MRR Card (indiepa.ge style) --}}
                <div class="p-4 rounded-xl bg-gradient-to-br from-emerald-500/10 via-zinc-50 to-emerald-500/5 dark:from-emerald-950/30 dark:via-[#0e1015] dark:to-emerald-900/10 border border-emerald-500/30 dark:border-emerald-500/20 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            MRR Total Público
                        </span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20 font-semibold">
                            En Vivo
                        </span>
                    </div>

                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-extrabold font-mono tracking-tight text-zinc-900 dark:text-white">
                            {{ $data->totalMonthlyRevenueFormatted }}
                        </span>
                    </div>

                    <div class="text-[11px] text-zinc-500 dark:text-zinc-400 font-mono flex items-center justify-between pt-1 border-t border-emerald-500/20">
                        <span>{{ $data->activeProjectsCount }} Proyectos Activos</span>
                        <span>{{ $data->verifiedProjectsCount }} Verificados</span>
                    </div>
                </div>

                {{-- Navigation Back & Quick Actions --}}
                <div class="space-y-2 pt-2 border-t border-zinc-200 dark:border-zinc-800">
                    <a
                        href="{{ route('home') }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-lg border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 text-zinc-700 dark:text-zinc-200 text-xs font-medium transition-colors"
                    >
                        <span>&larr;</span>
                        <span>Ver CV & Experiencia Laboral</span>
                    </a>

                    @auth
                        <a
                            href="{{ route('dashboard.projects') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-xs transition-colors"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Administrar Proyectos & MRR</span>
                        </a>
                    @endauth
                </div>

                {{-- Social Icons --}}
                <div class="flex items-center justify-between pt-2 text-xs font-mono text-zinc-500">
                    <a href="https://github.com/devcabeza" target="_blank" rel="noopener noreferrer" class="hover:text-zinc-900 dark:hover:text-white transition-colors">
                        GitHub
                    </a>
                    <span>&middot;</span>
                    <a href="https://linkedin.com/in/alejandro-cabeza" target="_blank" rel="noopener noreferrer" class="hover:text-zinc-900 dark:hover:text-white transition-colors">
                        LinkedIn
                    </a>
                    <span>&middot;</span>
                    <a href="https://x.com/devcabeza" target="_blank" rel="noopener noreferrer" class="hover:text-zinc-900 dark:hover:text-white transition-colors">
                        X / Twitter
                    </a>
                    <span>&middot;</span>
                    <a href="mailto:alejandrocabezaoficial@gmail.com" class="hover:text-zinc-900 dark:hover:text-white transition-colors">
                        Email
                    </a>
                </div>
            </div>
        </aside>

        {{-- Right Section: List of Personal Projects with Revenue & Subdomain Links --}}
        <main class="lg:col-span-8 space-y-6">
            {{-- Header of the list --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 border-b border-zinc-200 dark:border-zinc-800 pb-4">
                <div>
                    <span class="text-xs font-mono uppercase tracking-wider text-emerald-600 dark:text-emerald-400 font-semibold">
                        Open Startup &middot; Métricas Públicas
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight mt-0.5">
                        Proyectos Propios & Herramientas
                    </h2>
                </div>
                <p class="text-xs font-mono text-zinc-500">
                    {{ count($data->projects) }} productos disponibles
                </p>
            </div>

            {{-- Projects Loop --}}
            <div class="space-y-6">
                @forelse($data->projects as $project)
                    <article class="p-6 sm:p-7 rounded-2xl bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 shadow-xs hover:border-zinc-300 dark:hover:border-zinc-700 transition-all hover:shadow-md space-y-5">
                        {{-- Top Header Row: Icon, Title, Subdomain, and Revenue Pill --}}
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                {{-- Project Icon Badge --}}
                                <div class="w-12 h-12 rounded-xl bg-zinc-100 dark:bg-zinc-800/90 border border-zinc-200 dark:border-zinc-700/60 flex items-center justify-center text-zinc-800 dark:text-white font-bold font-mono text-base shrink-0">
                                    @if(strtolower($project->slug) === 'sendrix')
                                        <svg class="w-6 h-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @elseif(strtolower($project->slug) === 'laravertex')
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @elseif(strtolower($project->slug) === 'fillr')
                                        <svg class="w-6 h-6 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @else
                                        {{ strtoupper(substr($project->title, 0, 2)) }}
                                    @endif
                                </div>

                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-lg sm:text-xl font-bold text-zinc-900 dark:text-white">
                                            {{ $project->title }}
                                        </h3>
                                        @if($project->featured)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-medium bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                                Destacado
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2 mt-0.5">
                                        <a
                                            href="{{ $project->toolUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-xs font-mono text-zinc-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-1"
                                        >
                                            <span>{{ $project->subdomain }}.alejandrocabeza.dev</span>
                                            <span class="text-[10px]">↗</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Revenue Pill (indiepa.ge Stripe style) --}}
                            <div>
                                @if($project->monthlyRevenue > 0)
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs sm:text-sm font-bold font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>{{ $project->monthlyRevenueFormatted }}</span>
                                        @if($project->revenueVerified)
                                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20" title="Ingresos verificados">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-mono font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700/60">
                                        <span>$0/mo &middot; Gratuito / Crecimiento</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Tagline & Summary --}}
                        <div class="space-y-2">
                            <p class="text-sm sm:text-base font-medium text-zinc-800 dark:text-zinc-200 leading-snug">
                                {{ $project->tagline }}
                            </p>
                            <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                {{ $project->summary }}
                            </p>
                        </div>

                        {{-- Sparkline / Visual Trend Graph (indiepa.ge style) --}}
                        <div class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-100 dark:border-zinc-800 flex items-center justify-between gap-4">
                            <div class="space-y-0.5">
                                <span class="text-[11px] font-mono text-zinc-500 block">Tendencia & Disponibilidad</span>
                                <span class="text-xs font-mono font-semibold text-zinc-700 dark:text-zinc-300">
                                    {{ $project->status === 'active' ? '● En Producción 99.9% Uptime' : 'Mantenimiento' }}
                                </span>
                            </div>

                            {{-- Aesthetic SVG Sparkline --}}
                            <div class="w-32 sm:w-44 h-9">
                                <svg class="w-full h-full text-emerald-500/80 overflow-visible" viewBox="0 0 100 24" fill="none">
                                    <path d="M 0 18 Q 20 16, 35 12 T 70 8 T 100 3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="100" cy="3" r="2.5" class="fill-emerald-500" />
                                </svg>
                            </div>
                        </div>

                        {{-- Highlights --}}
                        @if(!empty($project->highlights))
                            <div class="space-y-1.5 pt-1">
                                <span class="text-[11px] font-mono uppercase tracking-wider text-zinc-400 dark:text-zinc-500">Puntos Clave</span>
                                <ul class="text-xs text-zinc-600 dark:text-zinc-300 space-y-1 pl-1">
                                    @foreach($project->highlights as $highlight)
                                        <li class="flex items-start gap-2">
                                            <span class="text-emerald-500 mt-0.5">&bull;</span>
                                            <span>{{ $highlight }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Tech Stack Pills --}}
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach($project->techStack as $tech)
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-mono bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200/70 dark:border-zinc-700/70">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Bottom Actions Row: Prominent Button to go directly to tool --}}
                        <div class="pt-2 border-t border-zinc-100 dark:border-zinc-800 flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <a
                                    href="{{ $project->toolUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-zinc-900 hover:bg-zinc-800 dark:bg-white dark:hover:bg-zinc-100 text-white dark:text-zinc-900 text-xs sm:text-sm font-semibold transition-all shadow-xs group"
                                    title="Abrir {{ $project->title }} en su subdominio dedicado"
                                >
                                    <span>Ir a la herramienta</span>
                                    <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform font-mono">↗</span>
                                </a>

                                @if($project->githubUrl)
                                    <a
                                        href="{{ $project->githubUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs font-mono transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                                        </svg>
                                        <span>Código</span>
                                    </a>
                                @endif
                            </div>

                            <span class="text-[11px] font-mono text-zinc-400 dark:text-zinc-500">
                                Rol: {{ $project->role }}
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="text-center py-12 border border-dashed border-zinc-300 dark:border-zinc-800 rounded-2xl p-8 space-y-3">
                        <p class="text-zinc-500 dark:text-zinc-400 text-sm">No hay proyectos personales registrados aún.</p>
                        @auth
                            <a href="{{ route('dashboard.projects') }}" class="btn btn-sm btn-primary">
                                Agregar tu primer proyecto
                            </a>
                        @endauth
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
