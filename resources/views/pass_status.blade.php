<!DOCTYPE html>
<html>
<head>
    <title>Bus Pass Status</title>
</head>
<body>
    <h2>Hello {{ $pass->name }}</h2>

    @if($status == 'approved')
        <p>🎉 Congratulations!</p>
        <p>Your <b>Bus Pass</b> has been <b style="color:green;">APPROVED</b>.</p>
        <p>You can now download your pass.</p>
    @else
        <p>❌ Sorry!</p>
        <p>Your <b>Bus Pass</b> has been <b style="color:red;">REJECTED</b>.</p>
        <p>Please contact admin for more details.</p>
    @endif

    <br>
    <p>Thanks,<br><b>Bus Pass Team</b></p>
</body>
</html>
