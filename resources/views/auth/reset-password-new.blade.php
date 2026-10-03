<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">

            <h1 class="login-title">Reset Password</h1>

            <p class="login-subtitle">
                Masukkan password baru kamu.
            </p>

            <form action="/reset-password/new" method="POST">
                @csrf

                <!-- Password Baru -->
                <div class="input-group-custom">
                    <i class="bi bi-lock"></i>

                    <input
                        type="password"
                        name="password"
                        id="newPassword"
                        placeholder="Password baru"
                        required
                    >

                    <span class="password-toggle" onclick="toggleNewPassword()">
                        <i class="bi bi-eye-slash" id="eyeIconNew"></i>
                    </span>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-group-custom">
                    <i class="bi bi-lock"></i>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="confirmNewPassword"
                        placeholder="Konfirmasi password baru"
                        required
                    >

                    <span class="password-toggle" onclick="toggleConfirmNewPassword()">
                        <i class="bi bi-eye-slash" id="eyeIconConfirmNew"></i>
                    </span>
                </div>

                <button type="submit" class="login-button">
                    Simpan Password Baru
                </button>

            </form>

        </div>
    </div>

    <script>
        function toggleNewPassword() {
            const input = document.getElementById('newPassword');
            const icon = document.getElementById('eyeIconNew');

            input.type = input.type === 'password' ? 'text' : 'password';

            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }

        function toggleConfirmNewPassword() {
            const input = document.getElementById('confirmNewPassword');
            const icon = document.getElementById('eyeIconConfirmNew');

            input.type = input.type === 'password' ? 'text' : 'password';

            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }
    </script>

</body>
</html>
