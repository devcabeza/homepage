<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin user seeder creates official alejandro cabeza user', function () {
    $this->seed(AdminUserSeeder::class);

    $this->assertDatabaseHas('users', [
        'email' => 'alejandrocabezaoficial@gmail.com',
        'name' => 'Alejandro Cabeza',
    ]);

    $user = User::query()->where('email', 'alejandrocabezaoficial@gmail.com')->firstOrFail();
    expect($user->email_verified_at)->not->toBeNull();
});

test('admin user seeder is idempotent and does not create duplicate users', function () {
    $this->seed(AdminUserSeeder::class);
    $this->seed(AdminUserSeeder::class);

    expect(User::query()->where('email', 'alejandrocabezaoficial@gmail.com')->count())->toBe(1);
});

test('dev login route logs in official admin and redirects to dashboard projects in local environment', function () {
    $response = $this->get('/dev-login');

    $response->assertRedirect(route('dashboard.projects'));
    $this->assertAuthenticated();

    /** @var User $authenticatedUser */
    $authenticatedUser = auth()->user();
    expect($authenticatedUser->email)->toBe('alejandrocabezaoficial@gmail.com');
});
