<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
});

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::post('/submit', [SubmissionController::class, 'store'])->name('submit.form');