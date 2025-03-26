<!DOCTYPE html>
<html>
<head>
    <title>Brand Approved</title>
</head>
<body>
    <p>Dear {{ $email }},</p>
    <p>Your brand has been approved!</p>
    <p><strong>Login Details:</strong></p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>You can log in at <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>
    <p>Best regards,<br>{{ config('app.name') }}</p>
</body>
</html>
