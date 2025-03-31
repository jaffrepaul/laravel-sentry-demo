<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('form');
});

// Test routes for different types of errors
Route::get('/trigger-error', function () {
    // experiment: add a breadcrumb before triggering the error
    Sentry\addBreadcrumb(
        category: 'test.error',
        message: 'Triggering an error for testing purposes',
    );

    throw new Exception('Triggered error for testing!');
});

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::get('/debug-db', function () {
    DB::connection()->getPdo()->exec('SELECT * FROM non_existent_table');
});

Route::get('/debug-auth', function () {
    throw new \Illuminate\Auth\AuthenticationException();
});

Route::get('/debug-not-found', function () {
    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
});

Route::post('/submit', [SubmissionController::class, 'store'])->name('submit.form');
