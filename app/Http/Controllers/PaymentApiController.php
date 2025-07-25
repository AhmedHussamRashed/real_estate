<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;

class PaymentApiController extends Controller
{
    //  جلب جميع العمليات
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'جميع العمليات',
            'data' => Payment::with('user')->latest()->get()
        ], 200);
    }

    //  جلب تفاصيل عملية معينة
    public function show($id)
    {
        try {
            $payment = Payment::with('user')->findOrFail($id);
            return response()->json(['status' => true, 'message' => 'تفاصيل العملية', 'data' => $payment], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'العملية غير موجودة'], 404);
        }
    }

    //  حفظ عملية جديدة
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:income,expense',
                'amount' => 'required|numeric',
                'description' => 'required|string'
            ]);

            $userId = $request->user_id ?? 1;

            $payment = Payment::create([
                'user_id' => $userId,
                'type' => $validated['type'],
                'amount' => $validated['amount'],
                'description' => $validated['description']
            ]);

            return response()->json([
                'status' => true,
                'message' => 'تم إنشاء العملية بنجاح',
                'data' => $payment
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'خطأ في البيانات المرسلة',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'خطأ غير متوقع'], 500);
        }
    }

    //  تحديث عملية
    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $validated = $request->validate([
                'type' => 'nullable|in:income,expense',
                'amount' => 'nullable|numeric',
                'description' => 'nullable|string'
            ]);

            $payment->update([
                'type' => $validated['type'] ?? $payment->type,
                'amount' => $validated['amount'] ?? $payment->amount,
                'description' => $validated['description'] ?? $payment->description
            ]);

            return response()->json(['status' => true, 'message' => 'تم التحديث بنجاح', 'data' => $payment], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'العملية غير موجودة أو خطأ غير متوقع'], 404);
        }
    }

    //  حذف عملية
    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'العملية غير موجودة'], 404);
        }
    }
}
