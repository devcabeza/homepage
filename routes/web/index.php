<?php

use App\Application\Health\Actions\CheckSystemHealthAction;
use App\Livewire\Portfolio\IndiePage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Main entry point for web routes. Feature routes are loaded from
| separate files for better organization.
|
*/

use Illuminate\Support\Facades\Route;

// Public routes
Route::view('/', 'portfolio')->name('home');
Route::get('/proyectos', IndiePage::class)->name('projects.index');
Route::redirect('/indie', '/proyectos');

Route::get('/cv/download', function () {
    $filePath = public_path('CV Alejandro Cabeza.pdf');
    abort_unless(file_exists($filePath), 404);

    return response()->download($filePath, 'CV_Alejandro_Cabeza.pdf', [
        'Content-Type' => 'application/pdf',
    ]);
})->name('cv.download');

// Health check (used by Docker HEALTHCHECK and monitoring)
Route::get('/health', function (CheckSystemHealthAction $healthAction) {
    $report = $healthAction->execute();
    $statusCode = $report['status'] === 'ok' ? 200 : 503;

    return response()->json($report, $statusCode);
})->name('health');

// Feature routes
require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/settings.php';
