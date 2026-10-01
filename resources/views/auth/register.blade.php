<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Inventori Gudang</title>

    @vite(['resources/css/login.css'])
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

                <div class="input-group-custom">
                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required>
                </div>

                <div class="input-group-custom">
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        required>
                </div>

                <div class="input-group-custom">
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required>
                </div>

                <div class="input-group-custom">
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required>
                </div>

                <button
                    type="submit"
                    class="login-button">

                    Sign up

                </button>

            </form>

            <div class="register-text">

                Already have an account?

                <a href="/login">
                    Log in
                </a>

            </div>

        </div>

    </div>

</body>

</html>