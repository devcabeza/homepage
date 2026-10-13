<?php

use App\Infrastructure\Persistence\Eloquent\Models\EloquentProject;
use App\Livewire\Dashboard\ProjectsManager;
use App\Models\User;
use Database\Seeders\PortfolioProjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PortfolioProjectsSeeder::class);
});

test('guest cannot access dashboard projects manager and is redirected to login', function () {
    $response = $this->get(route('dashboard.projects'));

    $response->assertRedirect(route('login'));
});

test('authenticated user can view dashboard projects manager', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard.projects'));

    $response->assertOk();
    $response->assertSee('Gestión de Proyectos & MRR', false);
    $response->assertSee('Sendrix');
    $response->assertSee('LaraVertex');
    $response->assertSee('Fillr');
});

test('authenticated user can create a new personal project with revenue', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('openCreate')
        ->assertSet('showModal', true)
        ->set('title', 'SaasMetrics')
        ->set('slug', 'saasmetrics')
        ->set('subdomain', 'metrics')
        ->set('tagline', 'Plataforma analítica para Indie Hackers')
        ->set('summary', 'Dashboard analítico y de tracking de métricas Stripe.')
        ->set('category', 'personal_tool')
        ->set('role', 'Creador & Lead Developer')
        ->set('monthlyRevenue', 250.00)
        ->set('status', 'active')
        ->set('revenueVerified', true)
        ->set('techStackInput', 'Laravel 13, Livewire 4, Tailwind CSS')
        ->set('highlightsInput', "Integración con Stripe Webhooks\nReportes en PDF automáticos")
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showModal', false)
        ->assertSee('¡Proyecto guardado correctamente!');

    $this->assertDatabaseHas('portfolio_projects', [
        'title' => 'SaasMetrics',
        'slug' => 'saasmetrics',
        'subdomain' => 'metrics',
        'monthly_revenue' => 250.00,
        'status' => 'active',
        'is_personal' => true,
    ]);
});

test('projects manager validates required inputs on save', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('openCreate')
        ->set('title', '')
        ->set('tagline', '')
        ->set('summary', '')
        ->call('save')
        ->assertHasErrors(['title', 'tagline', 'summary']);
});

test('authenticated user can edit project revenue and details', function () {
    $user = User::factory()->create();
    $project = EloquentProject::query()->where('slug', 'sendrix')->firstOrFail();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('openEdit', $project->id)
        ->assertSet('editingId', $project->id)
        ->assertSet('title', 'Sendrix')
        ->assertSet('showModal', true)
        ->set('monthlyRevenue', 980.00)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showModal', false);

    expect((float) EloquentProject::query()->where('slug', 'sendrix')->value('monthly_revenue'))
        ->toBe(980.0);
});

test('authenticated user can delete a project', function () {
    $user = User::factory()->create();
    $project = EloquentProject::query()->where('slug', 'fillr')->firstOrFail();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('deleteProject', $project->id)
        ->assertSee('Proyecto eliminado con éxito.');

    $this->assertDatabaseMissing('portfolio_projects', [
        'id' => $project->id,
    ]);
});

test('authenticated user can create a paid project by disabling the freemium checkbox', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('openCreate')
        ->assertSet('isFreemium', true)
        ->set('title', 'PaidConsole')
        ->set('slug', 'paidconsole')
        ->set('subdomain', 'paidconsole')
        ->set('tagline', 'Consola de facturación para equipos')
        ->set('summary', 'Plataforma de facturación con planes de pago por asiento.')
        ->set('category', 'personal_tool')
        ->set('role', 'Creador & Lead Developer')
        ->set('monthlyRevenue', 120.00)
        ->set('status', 'active')
        ->set('isFreemium', false)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('portfolio_projects', [
        'slug' => 'paidconsole',
        'is_freemium' => false,
    ]);
});

test('authenticated user can update the freemium model of an existing project', function () {
    $user = User::factory()->create();
    $project = EloquentProject::query()->where('slug', 'sendrix')->firstOrFail();

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->call('openEdit', $project->id)
        ->assertSet('isFreemium', true)
        ->set('isFreemium', false)
        ->call('save')
        ->assertHasNoErrors();

    expect((bool) EloquentProject::query()->where('slug', 'sendrix')->value('is_freemium'))
        ->toBeFalse();
});

test('projects manager filters the project list by freemium model', function () {
    $user = User::factory()->create();

    EloquentProject::query()->create([
        'slug' => 'paidconsole',
        'subdomain' => 'paidconsole',
        'title' => 'PaidConsole',
        'tagline' => 'Consola de facturación para equipos',
        'summary' => 'Plataforma de facturación con planes de pago por asiento.',
        'category' => 'personal_tool',
        'role' => 'Creador & Lead Developer',
        'tech_stack' => ['Laravel 13'],
        'highlights' => [],
        'is_personal' => true,
        'is_freemium' => false,
    ]);

    Livewire::actingAs($user)
        ->test(ProjectsManager::class)
        ->assertSet('pricingFilter', 'all')
        ->assertSee('Fillr')
        ->assertSee('PaidConsole')
        ->set('pricingFilter', 'paid')
        ->assertSee('PaidConsole')
        ->assertDontSee('Fillr')
        ->set('pricingFilter', 'freemium')
        ->assertSee('Fillr')
        ->assertDontSee('PaidConsole');
});
