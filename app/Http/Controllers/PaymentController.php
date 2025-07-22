<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    // عرض جميع المدفوعات
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    // عرض نموذج إضافة مدفوعات جديدة (لواجهة الويب)
    public function create()
    {
        $users = User::all(); // جلب جميع المستخدمين
        return view('payments.create', compact('users'));
    }

    // حفظ المدفوعات من واجهة الويب
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'تمت إضافة المدفوعات بنجاح.');
    }

    // حذف مدفوع
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'تم حذف المدفوع بنجاح.');
    }

    // إضافة جديدة عبر API
    public function storeFromApi(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        $payment = Payment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'تمت إضافة المعاملة بنجاح.',
            'payment' => $payment,
        ], 201);
    }
}
