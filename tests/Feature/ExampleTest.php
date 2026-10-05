<?php

test('health endpoint returns a successful response', function () {
    $response = $this->get('/health');

    $response->assertOk();
});

test('portfolio page renders successfully as the root route', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Alejandro Cabeza');
    $response->assertSee('Senior Software Engineer & TALL Stack Specialist', false);
    $response->assertSee('alejandrocabezaoficial@gmail.com');
});
