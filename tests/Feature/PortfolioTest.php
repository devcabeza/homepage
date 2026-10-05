<?php

use Database\Seeders\PortfolioProjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PortfolioProjectsSeeder::class);
});

test('portfolio page renders successfully on root route with 200 status', function () {
    $response = $this->get('/');

    $response->assertOk();
});

test('portfolio page contains exact identity and contact info from CV', function () {
    $response = $this->get('/');

    $response->assertSee('Alejandro Cabeza');
    $response->assertSee('alejandrocabezaoficial@gmail.com');
    $response->assertSee('Senior Software Engineer & TALL Stack Specialist', false);
    $response->assertSee('Tailwind · Alpine · Livewire · Laravel', false);
});

test('portfolio page displays all professional knowledge areas and CV metrics', function () {
    $response = $this->get('/');

    $response->assertSee('Ecosistema Laravel & Stack TALL', false);
    $response->assertSee('Liderazgo Técnico & Arquitectura', false);
    $response->assertSee('Infraestructura, DevOps & Cloud', false);
    $response->assertSee('Desarrollo de Herramientas & Ecosistema', false);

    $response->assertSee('-90% Latencia');
    $response->assertSee('-70% Tiempo');
    $response->assertSee('100% CI/CD');
    $response->assertSee('+5 Años');
});

test('portfolio page displays all professional experience companies from CV', function () {
    $response = $this->get('/');

    $response->assertSee('Aludespagroup');
    $response->assertSee('WallsTeam');
    $response->assertSee('AthenadeXFi');
    $response->assertSee('Genius Hormo (USA)');
    $response->assertSee('Prefexya');
    $response->assertSee('SEO Contenidos');
    $response->assertSee('Empresas Polar');
});

test('portfolio page showcases tools and personal projects from CV', function () {
    $response = $this->get('/');

    $response->assertSee('Sendrix');
    $response->assertSee('LaraVertex');
    $response->assertSee('Fillr');
});

test('portfolio page displays verified education from CV', function () {
    $response = $this->get('/');

    $response->assertSee('Ingeniería en Informática', false);
    $response->assertSee('TSU en Informática', false);
    $response->assertSee('IUPTAI');
});

test('portfolio page contains cv download button linking to download route', function () {
    $response = $this->get('/');

    $response->assertSee(route('cv.download'), false);
    $response->assertSee('Descargar CV (PDF)', false);
});

test('cv download route returns pdf download response with correct headers', function () {
    $response = $this->get(route('cv.download'));

    $response->assertOk();
    $response->assertDownload('CV_Alejandro_Cabeza.pdf');
    expect($response->headers->get('content-type'))->toContain('application/pdf');
});
