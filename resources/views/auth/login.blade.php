<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log in - Inventori Gudang</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/login.css'])
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <div class="login-title">
                <h1>Log in</h1>
            </div>

            <div class="login-subtitle">
                Log in to your account and seamlessly continue
                <br>
                managing your inventory.
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST">

                @csrf

                <div class="input-group-custom">

                    <i class="bi bi-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        value="{{ old('email') }}"
                        required>

                </div>

                <div class="input-group-custom">

                    <i class="bi bi-lock"></i>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        required>

                    <span
                        class="password-toggle"
                        onclick="togglePassword()">

                        <i class="bi bi-eye-slash" id="eyeIcon"></i>

                    </span>

                </div>

                <button
                    type="submit"
                    class="login-button">

                    Log in

                </button>

            </form>

            <div class="register-text">

                Don't have an account?

                <a href="/register">
                    Sign up
                </a>

            </div>

        </div>

    </div>


    <script>
        function togglePassword() {

            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');

            } else {

                password.type = 'password';

                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');

            }
        }
    </script>

</body>

</html>