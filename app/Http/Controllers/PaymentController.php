<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // عرض جميع المدفوعات في واجهة HTML
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    // عرض نموذج إضافة مدفوعات جديدة
    public function create()
    {
        return view('payments.create');
    }

    // حفظ المدفوعات الجديدة
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        // إنشاء المدفوعات
        Payment::create($validated);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('payments.index')->with('success', 'تمت إضافة المدفوعات بنجاح.');
    }
}
