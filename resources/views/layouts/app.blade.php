<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventori Gudang')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/inventori">
                📦 Inventori Gudang
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/inventori">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/inventori">
                            Data Barang
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            ⋮
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/supplier">
                                    <i class="bi bi-truck me-2"></i>
                                    Supplier
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/barang-masuk">
                                    <i class="bi bi-box-arrow-in-down me-2"></i>
                                    Barang Masuk
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-box-arrow-up me-2"></i>
                                    Barang Keluar
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </div>
    </nav>
    <!-- Isi halaman -->
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
</body>

</html>
