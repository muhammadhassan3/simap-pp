<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Project
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('asset/css/soft-ui-dashboard.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Tambahan css dari orang lain --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100 p-1">

    {{-- SIDEBAR COMPONENT --}}
    <x-sidebar></x-sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="margin-left: 260px;">
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <!-- End Navbar -->
        <div class="" style="margin-top: 10px;">
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidenav-main');
            const toggleBtn = document.getElementById('sidebarToggle');

            // Fungsi untuk atur tampilan sidebar sesuai ukuran layar
            function handleSidebar() {
                if (window.innerWidth < 992) {
                    // Layar kecil: sidebar offcanvas tersembunyi
                    sidebar.style.position = 'fixed';
                    sidebar.style.top = '0';
                    sidebar.style.left = '0';
                    sidebar.style.height = '100vh';
                    sidebar.style.width = '250px';
                    sidebar.style.backgroundColor = 'white';
                    sidebar.style.borderRight = '1px solid rgba(0,0,0,.125)';
                    sidebar.style.boxShadow = '2px 0 8px rgba(0,0,0,0.15)';
                    sidebar.style.transform = 'translateX(-100%)';
                    sidebar.style.transition = 'transform 0.3s ease';
                    sidebar.style.zIndex = '1050';

                    // Tutup sidebar (default)
                    sidebar.classList.remove('show');
                    sidebar.style.pointerEvents = 'none'; // agar tidak bisa klik saat tersembunyi

                } else {
                    // Layar besar: sidebar normal selalu tampil
                    sidebar.style.position = '';
                    sidebar.style.top = '';
                    sidebar.style.left = '';
                    sidebar.style.height = '';
                    sidebar.style.width = '';
                    sidebar.style.backgroundColor = '';
                    sidebar.style.borderRight = '';
                    sidebar.style.boxShadow = '';
                    sidebar.style.transform = 'none';
                    sidebar.style.transition = '';
                    sidebar.style.zIndex = '';
                    sidebar.style.pointerEvents = '';

                    sidebar.classList.remove('show');
                }
            }

            // Toggle sidebar on small screen
            toggleBtn.addEventListener('click', function() {
                if (sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    sidebar.style.transform = 'translateX(-100%)';
                    sidebar.style.pointerEvents = 'none';
                } else {
                    sidebar.classList.add('show');
                    sidebar.style.transform = 'translateX(0)';
                    sidebar.style.pointerEvents = 'auto';
                }
            });

            // Close sidebar when clicking outside it on small screens
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 992) {
                    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                        sidebar.classList.remove('show');
                        sidebar.style.transform = 'translateX(-100%)';
                        sidebar.style.pointerEvents = 'none';
                    }
                }
            });

            // Adjust on resize
            window.addEventListener('resize', handleSidebar);

            // Jalankan sekali saat halaman load
            handleSidebar();
        });
    </script> --}}

    @stack('scripts')
</body>

</html>
