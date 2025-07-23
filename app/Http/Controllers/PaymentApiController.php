<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Payment::with('user')->latest()->get()
        ], 200);
    }

    public function show($id)
    {
        $payment = Payment::with('user')->findOrFail($id);
        return response()->json(['status' => true, 'data' => $payment], 200);
    }

    public function store(Request $request)
    {
        //  تعديل التحقق ليتوافق مع بيانات التطبيق
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'currency' => 'nullable|string' // سيتم تحويلها إلى type
        ]);

        // إذا لم يتم إرسال user_id، ضع ID المستخدم الأول مؤقتًا
        $userId = $request->user_id ?? 1;

        // إنشاء الدفع
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
    }

    public function update(Request $request, $id)
    {
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

        return response()->json(['status' => true, 'data' => $payment], 200);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح'], 200);
    }
}
