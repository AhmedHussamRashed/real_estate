<!DOCTYPE html>
<html>
<head>
    <title>إضافة مدفوع</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h2>إضافة مدفوع جديد</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('payments.store') }}">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">معرف المستخدم</label>
            <input type="number" name="user_id" id="user_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">المبلغ</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</body>
</html>
