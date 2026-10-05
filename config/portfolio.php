<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Dominio Principal de Herramientas del Portafolio
    |--------------------------------------------------------------------------
    |
    | Base para construir los subdominios de cada proyecto personal:
    | https://{subdominio}.{root_domain}
    |
    */
    'root_domain' => env('PORTFOLIO_ROOT_DOMAIN', 'alejandrocabeza.dev'),

    /*
    |--------------------------------------------------------------------------
    | Correo del Administrador Autorizado
    |--------------------------------------------------------------------------
    |
    | Correo oficial con permisos para ingresar al dashboard administrativo.
    |
    */
    'admin_email' => env('PORTFOLIO_ADMIN_EMAIL', 'alejandrocabezaoficial@gmail.com'),
];
