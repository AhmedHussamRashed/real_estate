<!DOCTYPE html>
<html>
<head>
    <title>عرض المدفوعات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h2>قائمة المدفوعات</h2>

    <a href="{{ route('payments.create') }}" class="btn btn-success mb-3">إضافة مدفوع جديد</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المعرف</th>
                <th>المستخدم</th>
                <th>المبلغ</th>
                <th>الوصف</th>
                <th>تاريخ الإنشاء</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->user_id }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->description }}</td>
                    <td>{{ $payment->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
