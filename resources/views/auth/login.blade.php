<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="text-center mb-4">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            Don’t have an account? <a href="{{ route('register.form') }}">Register here</a>
        </p>
    </div>
</body>

</html>