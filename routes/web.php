<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is حيث يمكنك تسجيل المسارات (routes) لتطبيقك. يتم تحميل هذه
| المسارات من خلال RouteServiceProvider وستكون جميعها ضمن
| مجموعة web middleware.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ----------------------------
// Payments Routes
// ----------------------------

// عرض كل المدفوعات
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

// عرض نموذج إنشاء مدفوع جديد
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');

// حفظ المدفوع الجديد في قاعدة البيانات
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

// حذف مدفوع
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');


