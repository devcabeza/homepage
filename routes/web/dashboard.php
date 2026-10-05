<?php

use App\Livewire\Dashboard\ProjectsManager;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', ProjectsManager::class)->name('dashboard');
    Route::get('/dashboard/proyectos', ProjectsManager::class)->name('dashboard.projects');
});
