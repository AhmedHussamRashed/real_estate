<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentApiController; 

// إرجاع المستخدم الحالي إذا كان مسجلاً الدخول باستخدام Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentApiController::class, 'index']);       // عرض جميع المدفوعات
    Route::post('/', [PaymentApiController::class, 'store']);      // إنشاء دفعة جديدة
    Route::get('/{id}', [PaymentApiController::class, 'show']);    // عرض دفعة معينة
    Route::put('/{id}', [PaymentApiController::class, 'update']);  // تعديل دفعة
    Route::delete('/{id}', [PaymentApiController::class, 'destroy']); // حذف دفعة
});
