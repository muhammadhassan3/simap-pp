<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Monitoring Proyek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            /* Sidebar dimulai dari atas */
            left: 0;
            /* Tetap di sisi kiri */
            width: 16.6667%;
            /* Lebar sidebar (setara col-md-2) */
            height: 100vh;
            /* Sidebar memenuhi tinggi layar */
            background-color: #f8f9fa;
            /* Warna latar sidebar */
            z-index: 1000;
            /* Pastikan sidebar di atas konten */
        }

        /* Navbar */
        .navbar {
            margin-left: 16.6667%;
            /* Memberi jarak agar navbar tidak ketutup sidebar */
            height: 56px;
            /* Tinggi navbar sesuai default Bootstrap */
        }

        /* Main Content */
        .main-content {
            margin-left: 16.6667%;
            /* Beri jarak dari sidebar */
            margin-top: 56px;
            /* Beri ruang di bawah navbar */
            padding: 20px;
            /* Padding untuk konten */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            @include('components.navbar')
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>