<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentApiController;

// إرجاع المستخدم الحالي إذا كان مسجلاً الدخول باستخدام Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ----------------------------
// Payments Routes (API)
// ----------------------------
Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentApiController::class, 'index'])->name('api.payments.index');       // عرض جميع المدفوعات
    Route::post('/', [PaymentApiController::class, 'store'])->name('api.payments.store');      // إنشاء دفعة جديدة
    Route::get('/{id}', [PaymentApiController::class, 'show'])->name('api.payments.show');    // عرض دفعة معينة
    Route::put('/{id}', [PaymentApiController::class, 'update'])->name('api.payments.update'); // تعديل دفعة
    Route::delete('/{id}', [PaymentApiController::class, 'destroy'])->name('api.payments.destroy'); // حذف دفعة
});
