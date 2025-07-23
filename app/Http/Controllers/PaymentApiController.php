<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;

class PaymentApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'جميع العمليات',
            'data' => Payment::with('user')->latest()->get()
        ], 200);
    }

    public function show($id)
    {
        try {
            $payment = Payment::with('user')->findOrFail($id);
            return response()->json(['status' => true, 'message' => 'تفاصيل العملية', 'data' => $payment], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'العملية غير موجودة'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric',
                'description' => 'required|string',
                'currency' => 'nullable|string'
            ]);

            $userId = $request->user_id ?? 1;

            $payment = Payment::create([
                'user_id' => $userId,
                'amount' => $validated['amount'],
                'description' => $validated['description'],
                'type' => $validated['currency'] ?? 'USD'
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

    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $validated = $request->validate([
                'amount' => 'sometimes|numeric',
                'description' => 'nullable|string',
                'currency' => 'nullable|string'
            ]);

            $payment->update([
                'amount' => $validated['amount'] ?? $payment->amount,
                'description' => $validated['description'] ?? $payment->description,
                'type' => $validated['currency'] ?? $payment->type
            ]);

            return response()->json(['status' => true, 'message' => 'تم التحديث بنجاح', 'data' => $payment], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'العملية غير موجودة أو خطأ غير متوقع'], 404);
        }
    }

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
