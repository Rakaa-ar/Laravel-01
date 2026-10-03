<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Inventori Gudang</title>

    @vite(['resources/css/login.css'])
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-title">
                <h1>Sign up</h1>
            </div>

            <div class="login-subtitle">
                Create your account and start managing
                <br>
                your inventory.
            </div>

            <form action="/register" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="input-group-custom">
                    <i class="bi bi-person"></i>
                    <input type="text" name="name"
                        placeholder="Enter your name"
                        value="{{ old('name') }}" required>
                </div>

                <div class="input-group-custom">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email"
                        placeholder="Enter your email address"
                        value="{{ old('email') }}" required>
                </div>

                <div class="input-group-custom">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password"
                        id="password"
                        placeholder="Enter your password" required>

                    <span class="password-toggle"
                        onclick="togglePassword()">
                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                    </span>
                </div>

                <div class="input-group-custom">
                    <i class="bi bi-lock"></i>
                    <input type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Confirm your password" required>

                    <span class="password-toggle"
                        onclick="toggleConfirmPassword()">
                        <i class="bi bi-eye-slash"
                            id="eyeIconConfirm"></i>
                    </span>
                </div>

                <button type="submit" class="login-button">
                    Sign up
                </button>

            </form>

            <div class="register-text">
                Already have an account?
                <a href="/login">Log in</a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }

        function toggleConfirmPassword() {
            const input = document.getElementById('password_confirmation');
            const icon = document.getElementById('eyeIconConfirm');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }
    </script>

</body>
</html>

