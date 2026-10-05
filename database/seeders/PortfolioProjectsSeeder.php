<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\EloquentProject;
use Illuminate\Database\Seeder;

class PortfolioProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds with verified data from Alejandro Cabeza's CV.
     */
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'sendrix',
                'subdomain' => 'sendrix',
                'title' => 'Sendrix',
                'tagline' => 'Gestión y automatización eficiente de envíos y notificaciones multi-canal',
                'summary' => 'Plataforma y gateway de correo transaccional self-hosted de alta concurrencia. Centraliza autenticación de aplicaciones, encolado asíncrono con Redis Horizon, webhooks firmados HMAC y failover entre proveedores.',
                'category' => 'devops_infra',
                'role' => 'Creador & Arquitecto de Software',
                'period' => '2026',
                'metric_badge' => 'Multi-canal & Resiliente',
                'tech_stack' => ['Laravel 13', 'Livewire 4', 'Docker', 'Redis', 'PostgreSQL', 'Horizon', 'Webhooks', 'Tailwind CSS'],
                'highlights' => [
                    'Arquitectura desacoplada y orientada a eventos para tolerancia a fallos.',
                    'Orquestación asíncrona de colas en Redis para despacho masivo sin bloqueo.',
                    'Gestión automatizada de notificaciones transaccionales y eventos multi-proveedor.',
                ],
                'is_personal' => true,
                'featured' => true,
                'sort_order' => 1,
                'monthly_revenue' => 450.00,
                'status' => 'active',
                'revenue_verified' => true,
                'url' => 'https://sendrix.alejandrocabeza.dev',
                'github_url' => null,
            ],
            [
                'slug' => 'laravertex',
                'subdomain' => 'laravertex',
                'title' => 'LaraVertex',
                'tagline' => 'Paquete especializado para optimización modular y aceleración en Laravel',
                'summary' => 'Paquete / herramienta especializada para el ecosistema Laravel enfocada en extender capacidades modulares, optimización de datos y aceleración del ciclo de desarrollo.',
                'category' => 'personal_tool',
                'role' => 'Creador & Core Developer',
                'period' => '2026',
                'metric_badge' => 'Aceleración de Desarrollo',
                'tech_stack' => ['Laravel 13', 'Livewire 4', 'PHP 8.4', 'Capacitor 7', 'DaisyUI 5', 'Tailwind CSS v4'],
                'highlights' => [
                    'Capacidades modulares bajo Arquitectura Hexagonal (Ports & Adapters).',
                    'Integración de compilación nativa para Web y APK móvil con Capacitor.',
                    'Optimización de tiempos de setup y estandarización de componentes UI desacoplados.',
                ],
                'is_personal' => true,
                'featured' => true,
                'sort_order' => 2,
                'monthly_revenue' => 180.00,
                'status' => 'active',
                'revenue_verified' => true,
                'url' => 'https://laravertex.alejandrocabeza.dev',
                'github_url' => 'https://github.com/devcabeza/starter-kit',
            ],
            [
                'slug' => 'fillr',
                'subdomain' => 'fillr',
                'title' => 'Fillr',
                'tagline' => 'Generación, formateo y procesamiento inteligente de datos y formularios',
                'summary' => 'Utilidad desarrollada para automatizar la generación, formateo y procesamiento inteligente de datos y formularios dentro de entornos modernos.',
                'category' => 'personal_tool',
                'role' => 'Creador & Desarrollador',
                'period' => '2025 – 2026',
                'metric_badge' => 'Automatización Inteligente',
                'tech_stack' => ['TypeScript', 'JavaScript', 'DOM Automation', 'Data Formatter', 'Form Engine'],
                'highlights' => [
                    'Generación y parsing sintáctico automatizado para estructuras de formularios dinámicos.',
                    'Procesamiento client-side de alta velocidad con TypeScript.',
                    'Reducción drástica de tiempo en pruebas y llenado estructurado de datos.',
                ],
                'is_personal' => true,
                'featured' => true,
                'sort_order' => 3,
                'monthly_revenue' => 0.00,
                'status' => 'active',
                'revenue_verified' => false,
                'url' => 'https://fillr.alejandrocabeza.dev',
                'github_url' => null,
            ],
        ];

        EloquentProject::query()->whereNotIn('slug', array_column($projects, 'slug'))->delete();

        foreach ($projects as $projectData) {
            EloquentProject::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData,
            );
        }
    }
}
