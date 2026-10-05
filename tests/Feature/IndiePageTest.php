<?php

use App\Models\User;
use Database\Seeders\PortfolioProjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PortfolioProjectsSeeder::class);
});

test('indie projects page renders successfully with 200 status', function () {
    $response = $this->get(route('projects.index'));

    $response->assertOk();
    $response->assertSee('Proyectos Propios & Herramientas', false);
    $response->assertSee('MRR Total Público');
});

test('indie route aliases redirect to projects index', function () {
    $response = $this->get('/indie');

    $response->assertRedirect(route('projects.index'));
});

test('indie page displays personal projects with their monthly revenue and verification', function () {
    $response = $this->get(route('projects.index'));

    $response->assertSee('Sendrix');
    $response->assertSee('$450/mo');
    $response->assertSee('LaraVertex');
    $response->assertSee('$180/mo');
    $response->assertSee('Fillr');
    $response->assertSee('$0/mo');
});

test('indie page displays direct tool subdomains and direct action button', function () {
    $response = $this->get(route('projects.index'));

    $response->assertSee('https://sendrix.alejandrocabeza.dev', false);
    $response->assertSee('https://laravertex.alejandrocabeza.dev', false);
    $response->assertSee('https://fillr.alejandrocabeza.dev', false);
    $response->assertSee('Ir a la herramienta');
});

test('indie page calculates and shows total MRR aggregation', function () {
    $response = $this->get(route('projects.index'));

    // 450 + 180 + 0 = 630
    $response->assertSee('$630/mes');
    $response->assertSee('3 Proyectos Activos');
});

test('guest does not see admin projects link on indie page', function () {
    $response = $this->get(route('projects.index'));

    $response->assertDontSee(route('dashboard.projects'));
});

test('authenticated user sees admin projects link on indie page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('projects.index'));

    $response->assertSee(route('dashboard.projects'));
});
