@php
    $currentUser = $user ?? auth()->user();
@endphp

<div class="min-h-screen-safe flex flex-col w-full max-w-full">
    {{-- Top Navbar with Safe Area Support --}}
    <header class="border-b border-zinc-800/80 bg-zinc-900/80 backdrop-blur-xl sticky top-0 z-30 pt-safe">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 select-none group">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-4 ring-emerald-500/20"></span>
                    <span class="font-bold text-base sm:text-lg tracking-tight text-white group-hover:text-zinc-300 transition-colors">
                        Alejandro Cabeza
                    </span>
                    <span class="text-xs font-mono text-zinc-500 hidden sm:inline">&mdash; Panel de Control</span>
                </a>
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="btn btn-xs sm:btn-sm btn-ghost text-zinc-400 hover:text-white gap-1 font-mono text-xs hidden md:inline-flex"
                >
                    <span>Ver Portafolio</span>
                    <span class="text-[10px]">↗</span>
                </a>

                <a
                    href="{{ route('projects.index') }}"
                    target="_blank"
                    class="btn btn-xs sm:btn-sm btn-ghost text-zinc-300 hover:text-white gap-1 font-mono text-xs"
                >
                    <span>Ver Público (MRR)</span>
                    <span class="text-[10px]">↗</span>
                </a>

                <button
                    wire:click="openCreate"
                    class="btn btn-xs sm:btn-sm btn-primary gap-1 shadow-xs"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">+ Nuevo Proyecto</span>
                    <span class="sm:hidden">+ Nuevo</span>
                </button>

                @if($currentUser)
                    {{-- User Avatar Dropdown --}}
                    <x-dropdown align="end" width="w-64">
                        <x-slot:trigger>
                            <div class="flex items-center gap-2.5 p-1.5 rounded-2xl hover:bg-zinc-800/60 transition-colors cursor-pointer group">
                                <x-avatar :initials="$currentUser->initials()" size="sm" />
                                <div class="text-left hidden lg:block">
                                    <div class="text-xs font-medium text-white truncate max-w-[120px]">{{ $currentUser->name }}</div>
                                    <div class="text-[10px] text-zinc-400 truncate max-w-[120px]">{{ $currentUser->email }}</div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-zinc-400 group-hover:text-zinc-200 transition-transform duration-200 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </x-slot:trigger>

                        {{-- User Info Header --}}
                        <x-dropdown-header>
                            <div class="font-semibold text-white truncate">{{ $currentUser->name }}</div>
                            <div class="text-xs text-zinc-400 truncate font-normal">{{ $currentUser->email }}</div>
                        </x-dropdown-header>

                        <x-dropdown-separator />

                        <x-dropdown-item href="{{ route('profile') }}">
                            <x-slot:icon>
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </x-slot:icon>
                            Perfil
                        </x-dropdown-item>

                        <x-dropdown-item href="{{ route('settings') }}">
                            <x-slot:icon>
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </x-slot:icon>
                            Configuraciones
                        </x-dropdown-item>

                        <x-dropdown-separator />

                        <x-dropdown-item :action="route('auth.logout')" variant="danger">
                            <x-slot:icon>
                                <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </x-slot:icon>
                            Cerrar sesión
                        </x-dropdown-item>
                    </x-dropdown>
                @endif
            </div>
        </div>
    </header>

    {{-- Main Container --}}
    <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] md:pb-8 space-y-6">
        {{-- Welcome & Status Banner --}}
        @if($currentUser)
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-zinc-900 via-[#13141b] to-zinc-900 border border-zinc-800 p-5 sm:p-6 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold">Administrador Verificado</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                            ¡Hola, {{ $currentUser->name }}!
                        </h2>
                        <p class="text-xs sm:text-sm text-zinc-400 max-w-2xl">
                            Consola central para gestión de proyectos personales, actualización de ingresos recurrentes ($/mo) y subdominios en producción.
                        </p>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <button
                            wire:click="openCreate"
                            class="btn btn-sm btn-primary shadow-xs gap-1.5"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>+ Nuevo Proyecto</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Toast / Feedback Message --}}
        @if($feedbackMessage)
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ $feedbackMessage }}</span>
                </div>
                <button wire:click="$set('feedbackMessage', null)" class="text-emerald-400 hover:text-emerald-200">✕</button>
            </div>
        @endif

        {{-- 4 Useful Operational KPI Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-zinc-900 border border-emerald-500/30 bg-gradient-to-b from-emerald-950/20 to-zinc-900 space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono uppercase tracking-wider text-emerald-400 font-bold">MRR Total En Vivo</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold font-mono text-white">{{ $totalRevenueFormatted }}</div>
                <div class="text-xs text-zinc-400">Sumado automáticamente de proyectos activos</div>
            </div>

            <div class="p-5 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-1">
                <span class="text-xs font-mono uppercase tracking-wider text-indigo-400 font-bold">Total Proyectos</span>
                <div class="text-2xl sm:text-3xl font-bold font-mono text-white">{{ count($projects) }}</div>
                <div class="text-xs text-zinc-400">
                    {{ count(array_filter($projects, fn($p) => $p->status === 'active')) }} activos &middot; {{ count(array_filter($projects, fn($p) => $p->revenueVerified && $p->monthlyRevenue > 0)) }} con Stripe
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-1">
                <span class="text-xs font-mono uppercase tracking-wider text-amber-400 font-bold">Dominio Principal</span>
                <div class="text-lg sm:text-xl font-bold font-mono text-zinc-200 truncate">alejandrocabeza.dev</div>
                <div class="text-xs text-zinc-400">Resolución activa de subdominios</div>
            </div>

            <div class="p-5 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-1">
                <span class="text-xs font-mono uppercase tracking-wider text-sky-400 font-bold">Gateway Sendrix</span>
                <div class="text-lg sm:text-xl font-bold font-mono text-zinc-200">Operativo</div>
                <div class="text-xs text-zinc-400">Encolado asíncrono y failover activo</div>
            </div>
        </div>

        {{-- Projects Table / Card List --}}
        <div class="rounded-2xl bg-zinc-900 border border-zinc-800 overflow-hidden shadow-xs">
            <div class="p-4 sm:p-5 border-b border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="font-bold text-white text-base sm:text-lg">Gestión de Proyectos & MRR</h3>
                    <p class="text-xs text-zinc-400 mt-0.5">Controla montos de revenue, visibilidad pública y URLs de subdominio.</p>
                </div>

                <button
                    wire:click="openCreate"
                    class="btn btn-xs sm:btn-sm btn-primary self-start sm:self-auto gap-1"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Agregar Proyecto</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full text-sm text-left">
                    <thead class="text-xs font-mono text-zinc-400 uppercase bg-zinc-950/60 border-b border-zinc-800">
                        <tr>
                            <th class="py-3.5 px-4">Proyecto</th>
                            <th class="py-3.5 px-4">Subdominio / Enlace</th>
                            <th class="py-3.5 px-4">MRR ($/mes)</th>
                            <th class="py-3.5 px-4">Estado</th>
                            <th class="py-3.5 px-4">Verificado</th>
                            <th class="py-3.5 px-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse($projects as $p)
                            <tr class="hover:bg-zinc-800/40 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="font-bold text-white text-sm sm:text-base">{{ $p->title }}</div>
                                    <div class="text-xs text-zinc-400 max-w-xs truncate">{{ $p->tagline }}</div>
                                </td>
                                <td class="py-4 px-4 font-mono text-xs">
                                    <a
                                        href="{{ $p->resolveToolUrl() }}"
                                        target="_blank"
                                        class="text-indigo-400 hover:text-indigo-300 inline-flex items-center gap-1"
                                        title="Abrir subdominio"
                                    >
                                        <span>{{ $p->subdomain ?? $p->slug }}.alejandrocabeza.dev</span>
                                        <span class="text-[10px]">↗</span>
                                    </a>
                                </td>
                                <td class="py-4 px-4 font-mono font-bold text-emerald-400">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        <span>{{ $p->formattedMonthlyRevenue() }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if($p->status === 'active')
                                        <span class="px-2 py-0.5 rounded-full text-xs font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            Activo
                                        </span>
                                    @elseif($p->status === 'development')
                                        <span class="px-2 py-0.5 rounded-full text-xs font-mono font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            En Desarrollo
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs font-mono font-medium bg-zinc-800 text-zinc-400">
                                            Pausado
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-xs font-mono">
                                    @if($p->revenueVerified)
                                        <span class="text-emerald-400 font-semibold inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Verificado</span>
                                        </span>
                                    @else
                                        <span class="text-zinc-500">Estimado</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-right space-x-1 sm:space-x-2">
                                    <button
                                        wire:click="openEdit({{ $p->id }})"
                                        class="btn btn-xs btn-ghost text-zinc-300 hover:text-white"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        wire:click="deleteProject({{ $p->id }})"
                                        wire:confirm="¿Estás seguro de eliminar el proyecto '{{ $p->title }}'?"
                                        class="btn btn-xs btn-ghost text-rose-400 hover:text-rose-300"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-zinc-500">
                                    No hay proyectos registrados aún. Haz clic en "+ Nuevo Proyecto" para comenzar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/70 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-zinc-900 border border-zinc-800 text-zinc-100 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 space-y-5 shadow-2xl">
                <div class="flex items-center justify-between pb-3 border-b border-zinc-800">
                    <h3 class="text-lg font-bold text-white">
                        {{ $editingId ? 'Editar Proyecto & Revenue' : 'Crear Nuevo Proyecto Personal' }}
                    </h3>
                    <button wire:click="closeModal" class="text-zinc-400 hover:text-white text-lg">✕</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Nombre del Proyecto *</label>
                            <input
                                type="text"
                                wire:model.live="title"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                                placeholder="Ej. Sendrix"
                                required
                            />
                            @error('title') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Subdominio Dedicado *</label>
                            <div class="flex items-center rounded-lg bg-zinc-950 border border-zinc-700 overflow-hidden focus-within:border-indigo-500">
                                <input
                                    type="text"
                                    wire:model="subdomain"
                                    class="w-full px-3 py-2 bg-transparent text-white text-sm focus:outline-none"
                                    placeholder="sendrix"
                                    required
                                />
                                <span class="px-2.5 text-xs font-mono text-zinc-500 bg-zinc-800/60 py-2 border-l border-zinc-700">.alejandrocabeza.dev</span>
                            </div>
                            @error('subdomain') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Ingresos Mensuales (USD) *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-zinc-500 font-mono text-sm">$</span>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    wire:model="monthlyRevenue"
                                    class="w-full pl-7 pr-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white font-mono text-sm focus:border-indigo-500 focus:outline-none"
                                    placeholder="450.00"
                                    required
                                />
                            </div>
                            @error('monthlyRevenue') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Estado *</label>
                            <select
                                wire:model="status"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                            >
                                <option value="active">Activo / Producción</option>
                                <option value="development">En Desarrollo</option>
                                <option value="paused">Pausado</option>
                            </select>
                            @error('status') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Categoría *</label>
                            <select
                                wire:model="category"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                            >
                                <option value="personal_tool">Herramientas & Open Source</option>
                                <option value="devops_infra">Infraestructura & DevOps</option>
                                <option value="enterprise">Sistemas Empresariales</option>
                            </select>
                            @error('category') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-zinc-400 mb-1">Tagline Corto *</label>
                        <input
                            type="text"
                            wire:model="tagline"
                            class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                            placeholder="Ej. Gestión y automatización eficiente de envíos y notificaciones multi-canal"
                            required
                        />
                        @error('tagline') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-zinc-400 mb-1">Descripción / Resumen Operativo *</label>
                        <textarea
                            wire:model="summary"
                            rows="3"
                            class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                            placeholder="Plataforma y gateway de correo transaccional..."
                            required
                        ></textarea>
                        @error('summary') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Stack Tecnológico (separado por comas)</label>
                            <input
                                type="text"
                                wire:model="techStackInput"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none font-mono text-xs"
                                placeholder="Laravel 13, Livewire 4, Docker, Redis"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Rol Desempeñado *</label>
                            <input
                                type="text"
                                wire:model="role"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                                placeholder="Creador & Arquitecto de Software"
                                required
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-zinc-400 mb-1">Puntos Clave / Highlights (uno por línea)</label>
                        <textarea
                            wire:model="highlightsInput"
                            rows="2"
                            class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none"
                            placeholder="Arquitectura desacoplada y orientada a eventos.&#10;Orquestación asíncrona de colas en Redis."
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Repositorio GitHub (Opcional)</label>
                            <input
                                type="url"
                                wire:model="githubUrl"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none font-mono text-xs"
                                placeholder="https://github.com/..."
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-zinc-400 mb-1">Orden de Visualización</label>
                            <input
                                type="number"
                                wire:model="sortOrder"
                                class="w-full px-3 py-2 rounded-lg bg-zinc-950 border border-zinc-700 text-white text-sm focus:border-indigo-500 focus:outline-none font-mono text-xs"
                                min="0"
                            />
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:model="revenueVerified"
                                    class="checkbox checkbox-primary checkbox-sm"
                                />
                                <span class="text-xs text-zinc-300 font-medium">Ingresos Verificados (Stripe)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-800">
                        <button
                            type="button"
                            wire:click="closeModal"
                            class="btn btn-sm btn-ghost text-zinc-400 hover:text-white"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            class="btn btn-sm btn-primary shadow-xs"
                        >
                            {{ $editingId ? 'Actualizar Proyecto' : 'Crear Proyecto' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Mobile bottom navigation --}}
    <x-app-bottom-nav />
</div>
