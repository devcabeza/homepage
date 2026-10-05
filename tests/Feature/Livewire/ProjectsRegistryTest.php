<?php

use App\Livewire\Portfolio\ProjectsRegistry;
use Database\Seeders\PortfolioProjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PortfolioProjectsSeeder::class);
});

test('projects registry component renders successfully with projects', function () {
    Livewire::test(ProjectsRegistry::class)
        ->assertStatus(200)
        ->assertSee('Sendrix')
        ->assertSee('LaraVertex')
        ->assertSee('Fillr');
});

test('projects registry exclusively displays personal projects and excludes employment companies', function () {
    Livewire::test(ProjectsRegistry::class)
        ->assertSee('Sendrix')
        ->assertSee('LaraVertex')
        ->assertSee('Fillr')
        ->assertDontSee('Aludespagroup')
        ->assertDontSee('WallsTeam')
        ->assertDontSee('AthenadeXFi')
        ->assertDontSee('Genius Hormo')
        ->assertDontSee('Prefexya')
        ->assertDontSee('SEO Contenidos');
});

test('projects registry can filter by personal tools category', function () {
    Livewire::test(ProjectsRegistry::class)
        ->call('setCategory', 'personal_tool')
        ->assertSee('LaraVertex')
        ->assertSee('Fillr')
        ->assertDontSee('Sendrix');
});

test('projects registry can filter by devops and infrastructure category', function () {
    Livewire::test(ProjectsRegistry::class)
        ->call('setCategory', 'devops_infra')
        ->assertSee('Sendrix')
        ->assertDontSee('Fillr')
        ->assertDontSee('LaraVertex');
});

test('projects registry can search by technology keyword', function () {
    Livewire::test(ProjectsRegistry::class)
        ->set('search', 'TypeScript')
        ->assertSee('Fillr')
        ->assertDontSee('Sendrix');
});

test('projects registry opens and closes project architecture modal', function () {
    Livewire::test(ProjectsRegistry::class)
        ->assertSet('selectedSlug', null)
        ->call('showProject', 'sendrix')
        ->assertSet('selectedSlug', 'sendrix')
        ->assertSee('Arquitectura desacoplada y orientada a eventos para tolerancia a fallos.', false)
        ->call('closeModal')
        ->assertSet('selectedSlug', null);
});

test('projects registry can reset filters', function () {
    Livewire::test(ProjectsRegistry::class)
        ->set('category', 'personal_tool')
        ->set('search', 'Fillr')
        ->call('clearFilters')
        ->assertSet('category', 'all')
        ->assertSet('search', '');
});

test('projects registry renders direct subdomain tool links for all personal projects', function () {
    Livewire::test(ProjectsRegistry::class)
        ->assertSee('https://sendrix.alejandrocabeza.dev', false)
        ->assertSee('https://laravertex.alejandrocabeza.dev', false)
        ->assertSee('https://fillr.alejandrocabeza.dev', false)
        ->assertSee('Ir a la herramienta');
});

test('architecture modal displays direct tool link button with subdomain', function () {
    Livewire::test(ProjectsRegistry::class)
        ->call('showProject', 'laravertex')
        ->assertSee('https://laravertex.alejandrocabeza.dev', false)
        ->assertSee('Abrir Herramienta');
});
