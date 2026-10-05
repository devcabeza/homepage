<div class="space-y-6" id="proyectos">
    {{-- Minimalist Section Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-2 border-b border-zinc-200 dark:border-zinc-800/80">
        <div>
            <span class="text-xs font-mono uppercase tracking-wider text-zinc-500">Portfolio & Herramientas</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white tracking-tight mt-1">
                Proyectos Propios
            </h2>
            <p class="text-zinc-600 dark:text-zinc-400 text-sm mt-1">
                Herramientas open source, paquetes y soluciones de infraestructura desarrolladas por mí.
            </p>
        </div>

        {{-- Minimalist Search Input --}}
        <div class="w-full sm:w-64 shrink-0">
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.250ms="search"
                    placeholder="Buscar por tecnología..."
                    class="w-full pl-3 pr-8 py-2 bg-white dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-500 focus:border-zinc-400 dark:focus:border-zinc-600 focus:outline-none rounded-lg text-xs min-h-[38px] transition-colors shadow-2xs"
                />
                @if ($search)
                    <button
                        type="button"
                        wire:click="$set('search', '')"
                        class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-zinc-400 hover:text-zinc-700 dark:text-zinc-500 dark:hover:text-zinc-300"
                        aria-label="Limpiar búsqueda"
                    >
                        ✕
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Minimalist Filter Pills --}}
    <div class="flex items-center gap-1.5 overflow-x-auto pb-1 scrollbar-none">
        <button
            type="button"
            wire:click="setCategory('all')"
            class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shrink-0 flex items-center gap-1.5 {{ $category === 'all' ? 'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 border border-zinc-900 dark:border-zinc-100 font-semibold' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-transparent' }}"
        >
            <span>Todos</span>
            <span class="text-[10px] font-mono {{ $category === 'all' ? 'text-zinc-300 dark:text-zinc-700' : 'text-zinc-400 dark:text-zinc-500' }}">({{ $counts['all'] }})</span>
        </button>

        @if ($counts['personal_tool'] > 0)
            <button
                type="button"
                wire:click="setCategory('personal_tool')"
                class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shrink-0 flex items-center gap-1.5 {{ $category === 'personal_tool' ? 'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 border border-zinc-900 dark:border-zinc-100 font-semibold' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-transparent' }}"
            >
                <span>Herramientas & Open Source</span>
                <span class="text-[10px] font-mono {{ $category === 'personal_tool' ? 'text-zinc-300 dark:text-zinc-700' : 'text-zinc-400 dark:text-zinc-500' }}">({{ $counts['personal_tool'] }})</span>
            </button>
        @endif

        @if ($counts['devops_infra'] > 0)
            <button
                type="button"
                wire:click="setCategory('devops_infra')"
                class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shrink-0 flex items-center gap-1.5 {{ $category === 'devops_infra' ? 'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 border border-zinc-900 dark:border-zinc-100 font-semibold' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-transparent' }}"
            >
                <span>Infraestructura & Cloud</span>
                <span class="text-[10px] font-mono {{ $category === 'devops_infra' ? 'text-zinc-300 dark:text-zinc-700' : 'text-zinc-400 dark:text-zinc-500' }}">({{ $counts['devops_infra'] }})</span>
            </button>
        @endif

        @if ($counts['enterprise'] > 0)
            <button
                type="button"
                wire:click="setCategory('enterprise')"
                class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shrink-0 flex items-center gap-1.5 {{ $category === 'enterprise' ? 'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 border border-zinc-900 dark:border-zinc-100 font-semibold' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-transparent' }}"
            >
                <span>Sistemas Empresariales</span>
                <span class="text-[10px] font-mono {{ $category === 'enterprise' ? 'text-zinc-300 dark:text-zinc-700' : 'text-zinc-400 dark:text-zinc-500' }}">({{ $counts['enterprise'] }})</span>
            </button>
        @endif
    </div>

    {{-- Projects Grid --}}
    @if (empty($projects))
        <div class="py-12 text-center rounded-xl bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 p-6 space-y-2">
            <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">No se encontraron proyectos</h3>
            <p class="text-xs text-zinc-600 dark:text-zinc-400">
                No hay resultados para "{{ $search }}". Intenta con otra tecnología.
            </p>
            <div class="pt-2">
                <x-button wire:click="clearFilters" variant="ghost" size="xs">
                    Restablecer filtros
                </x-button>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($projects as $project)
                <div
                    wire:key="project-card-{{ $project->id }}"
                    class="flex flex-col justify-between rounded-xl p-5 bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800/80 hover:border-zinc-300 dark:hover:border-zinc-700 shadow-xs hover:shadow-sm transition-all"
                >
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2 text-xs">
                            <span class="font-mono text-zinc-500 dark:text-zinc-400 text-[11px]">
                                {{ $project->categoryLabel }}
                            </span>
                            @if ($project->metricBadge)
                                <span class="font-mono text-[11px] px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 font-medium">
                                    {{ $project->metricBadge }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <div class="flex items-baseline justify-between gap-2">
                                <h3 class="text-base font-bold text-zinc-900 dark:text-white tracking-tight">
                                    {{ $project->title }}
                                </h3>
                                @if ($project->period)
                                    <span class="text-[10px] font-mono text-zinc-500 dark:text-zinc-400 shrink-0">
                                        {{ $project->period }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5 font-mono">
                                {{ $project->role }}
                            </p>
                        </div>

                        <p class="text-xs text-zinc-600 dark:text-zinc-300 leading-relaxed">
                            {{ $project->summary }}
                        </p>

                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach ($project->techStack as $tech)
                                <span class="text-[10px] px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800/80 text-zinc-600 dark:text-zinc-300 border border-zinc-200/80 dark:border-zinc-700/60 font-mono">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-zinc-100 dark:border-zinc-800/80 flex flex-col gap-3 text-xs">
                        @if ($project->toolUrl)
                            <div class="flex items-center justify-between gap-2">
                                <a
                                    href="{{ $project->toolUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 hover:bg-zinc-800 dark:hover:bg-white text-xs font-medium transition-all shadow-2xs group"
                                    title="Ir directamente a la herramienta ({{ $project->toolUrl }})"
                                >
                                    <span>Ir a la herramienta</span>
                                    <svg class="w-3.5 h-3.5 text-zinc-400 dark:text-zinc-500 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>

                                <span class="font-mono text-[11px] text-zinc-400 dark:text-zinc-500 truncate max-w-[130px] sm:max-w-[150px]">
                                    {{ parse_url($project->toolUrl, PHP_URL_HOST) }}
                                </span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between text-xs">
                            <button
                                type="button"
                                wire:click="showProject('{{ $project->slug }}')"
                                class="text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-950 dark:hover:text-white transition-colors underline underline-offset-4 select-none min-h-[32px] cursor-pointer font-medium"
                            >
                                Ficha de Arquitectura
                            </button>

                            <div class="flex items-center gap-3">
                                @if ($project->githubUrl)
                                    <a
                                        href="{{ $project->githubUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-200 transition-colors text-xs font-mono font-medium"
                                        title="Ver repositorio"
                                    >
                                        GitHub ↗
                                    </a>
                                @endif

                                @if ($project->toolUrl)
                                    <a
                                        href="{{ $project->toolUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-zinc-800 dark:text-zinc-200 hover:text-zinc-950 dark:hover:text-white transition-colors text-xs font-mono font-semibold"
                                        title="Visitar subdominio de la herramienta"
                                    >
                                        En línea ↗
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Minimalist Architecture Modal --}}
    @if ($activeProject)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-zinc-950/40 dark:bg-black/80 backdrop-blur-sm"
            x-data
            @keydown.escape.window="$wire.closeModal()"
        >
            <div
                class="relative w-full max-w-xl max-h-[85vh] overflow-y-auto rounded-2xl bg-white dark:bg-[#13141b] border border-zinc-200 dark:border-zinc-800 p-6 space-y-5 text-zinc-900 dark:text-zinc-100 shadow-2xl"
                @click.outside="$wire.closeModal()"
            >
                <div class="flex items-start justify-between gap-4 border-b border-zinc-200 dark:border-zinc-800 pb-4">
                    <div>
                        <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">{{ $activeProject->categoryLabel }}</span>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mt-1">{{ $activeProject->title }}</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 font-mono mt-0.5">{{ $activeProject->role }} @if ($activeProject->period) &middot; {{ $activeProject->period }} @endif</p>
                    </div>
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="text-zinc-400 hover:text-zinc-700 dark:text-zinc-500 dark:hover:text-zinc-200 p-1.5 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer"
                        aria-label="Cerrar modal"
                    >
                        ✕
                    </button>
                </div>

                <div class="space-y-2">
                    <h4 class="text-xs font-mono uppercase tracking-wider text-zinc-500 dark:text-zinc-400 font-semibold">Resumen</h4>
                    <p class="text-xs sm:text-sm text-zinc-700 dark:text-zinc-300 leading-relaxed">{{ $activeProject->summary }}</p>
                </div>

                @if (!empty($activeProject->highlights))
                    <div class="space-y-2">
                        <h4 class="text-xs font-mono uppercase tracking-wider text-zinc-500 dark:text-zinc-400 font-semibold">Aspectos Clave de Arquitectura</h4>
                        <ul class="space-y-1.5 text-xs sm:text-sm text-zinc-700 dark:text-zinc-300">
                            @foreach ($activeProject->highlights as $highlight)
                                <li class="flex items-start gap-2">
                                    <span class="text-zinc-400 dark:text-zinc-500 mt-0.5">&bull;</span>
                                    <span>{{ $highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-2">
                    <h4 class="text-xs font-mono uppercase tracking-wider text-zinc-500 dark:text-zinc-400 font-semibold">Tecnologías</h4>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($activeProject->techStack as $tech)
                            <span class="text-xs px-2.5 py-1 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200/80 dark:border-zinc-700/80 font-mono">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-end gap-2">
                    @if ($activeProject->githubUrl)
                        <x-button
                            href="{{ $activeProject->githubUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            variant="outline"
                            size="sm"
                            class="border-zinc-300 dark:border-zinc-700 bg-white dark:bg-transparent text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800"
                        >
                            Ver en GitHub
                        </x-button>
                    @endif

                    @if ($activeProject->toolUrl)
                        <x-button
                            href="{{ $activeProject->toolUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            variant="primary"
                            size="sm"
                            class="inline-flex items-center gap-1.5"
                        >
                            <span>Abrir Herramienta</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </x-button>
                    @endif

                    <x-button
                        type="button"
                        wire:click="closeModal"
                        variant="ghost"
                        size="sm"
                    >
                        Cerrar
                    </x-button>
                </div>
            </div>
        </div>
    @endif
</div>
