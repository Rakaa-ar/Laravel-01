<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Inventori Gudang</title>
    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-title">
                <h1>Forgot Password</h1>
            </div>

            <div class="login-subtitle">
                Enter Your Registered email to reset your password.
            </div>

            @if ($errors->any())
                <div class="error-messange">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/forgot-password" method="POST">
                @csrf

                <div class="input-group-custom">
                    <input type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}"
                        required>
                </div>
                <button type="submit" class="login-button"> Send OTP </button>

            </form>
            <div class="register-text"> Remember your password? <a href="/login">Login</a> </div>
        </div>
    </div>

</body>

</html>
