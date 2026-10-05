<?php

use App\Livewire\Auth\MagicLogin;
use App\Livewire\Auth\VerifyToken;
use App\Models\User;
use App\Ports\In\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Passwordless Magic Link)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/auth', MagicLogin::class)->name('auth.login');
    Route::get('/login', MagicLogin::class)->name('login');
    Route::get('/auth/verify', VerifyToken::class)->name('auth.verify');
});

Route::post('/auth/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

if (app()->environment('local', 'testing')) {
    Route::get('/dev-login', function () {
        $user = User::firstOrCreate(
            ['email' => 'alejandrocabezaoficial@gmail.com'],
            [
                'name' => 'Alejandro Cabeza',
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboard.projects');
    })->name('auth.dev-login');
}
