<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP - Inventori Gudang</title>

    @vite(['resources/css/login.css'])
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <div class="login-title">
                <h1>Verify OTP</h1>
            </div>

            <div class="login-subtitle">
                Enter the 6-digit code sent to your email.
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/verify-otp" method="POST">

                @csrf

                <div class="input-group-custom">
                    <input type="text" name="otp" placeholder="Enter OTP" maxlength="6" inputmode="numeric"
                        required>
                </div>

                <button type="submit" class="login-button">
                    Verify
                </button>

            </form>

            <div class="register-text">
                Didn't receive the code?
                <a href="#">Resend OTP</a>
            </div>

        </div>

    </div>

</body>

</html>
