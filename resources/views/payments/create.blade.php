<!DOCTYPE html>
<html>
<head>
    <title>Send Payment - PayPal Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #0070ba;
            color: white;
            border-radius: 15px 15px 0 0;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #0070ba;
            border: none;
        }
        .btn-primary:hover {
            background-color: #005c99;
        }
    </style>
</head>
<body class="py-5">

    <div class="card">
        <div class="card-header">
            Send Payment via PayPal
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('payments.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label">Select User</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        <option value="">-- Choose a User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount ($)</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" placeholder="e.g. 49.99" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Payment Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="e.g. Payment for design service">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Currency (e.g. USD)</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" placeholder="USD, EUR...">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4">Send Payment</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
