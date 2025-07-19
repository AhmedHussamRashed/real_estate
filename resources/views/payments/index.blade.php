<!DOCTYPE html>
<html>
<head>
    <title> Payments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h2> Payment List</h2>

    <a href="{{ route('payments.create') }}" class="btn btn-success mb-3">  Add New Payments</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>IP</th>
                <th>USER</th>
                <th>AMOUNT</th>
                <th>Description</th>
                <th> Date Of Establishment</th>
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
