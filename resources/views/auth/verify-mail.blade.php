<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>

<body>

    <h2>Please Verify Your Email</h2>
    <p>We have sent a verification link to your email. Please check your inbox.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Email</button>
    </form>

    @if (session('message'))
    <p>{{ session('message') }}</p>
    @endif

</body>

</html>