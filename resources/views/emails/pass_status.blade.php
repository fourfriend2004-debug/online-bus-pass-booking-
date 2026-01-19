<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bus Pass Status</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

    <div style="max-width:600px; background:#ffffff; padding:20px; margin:auto; border-radius:8px;">
        <h2>Bus Pass Status Update</h2>

        <p>Hello <strong>{{ $pass->student_name ?? $pass->full_name }}</strong>,</p>

        <p>
            Your bus pass request (<strong>#BK-{{ $pass->id }}</strong>) has been
            <strong style="color:
                {{ $pass->status == 'approved' ? 'green' : 'red' }}">
                {{ strtoupper($pass->status) }}
            </strong>.
        </p>

        @if($pass->status == 'approved')
            <p>Your pass is now active.</p>
        @else
            <p>Unfortunately, your pass request was rejected.</p>
        @endif

        <p>
            Route: {{ $pass->from_location }} → {{ $pass->to_location }} <br>
            Pass Type: {{ ucfirst($pass->pass_type) }}
        </p>

        <br>
        <p>Thank you,<br><strong>Bus Pass Team</strong></p>
    </div>

</body>
</html>
