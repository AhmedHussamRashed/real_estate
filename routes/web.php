<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('payments.create');
});

// ----------------------------
// Payments Routes (Web)
// ----------------------------
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
