<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h1 class="login-title">Verifikasi OTP</h1>
            <p class="login-subtitle">
                Masukkan kode OTP yang dikirim ke email kamu.
            </p>

            <form action="/reset-password/verify" method="POST">
                @csrf

                <div class="input-group-custom">
                    <input type="text" name="otp" placeholder="Masukkan kode OTP" maxlength="6" required>
                </div>

                <button type="submit" class="login-button">
                    Verifikasi OTP
                </button>
            </form>
        </div>
    </div>
</body>

</html>
