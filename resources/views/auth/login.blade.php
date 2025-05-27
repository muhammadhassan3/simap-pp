<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .alert.fade {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }

    </style>
</head>
<body>

<div class="container d-flex flex-column align-items-center justify-content-center vh-100">
    <!-- Logo -->
    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="mb-3" style="max-width: 200px;">

    <!-- Form Login -->
    <div class="card shadow-lg p-4 text-white" style="max-width: 400px; width: 100%; border-radius: 10px; background:#007BC3">
        <div class="card-body">
            <h3 class="text-center fw-bold">Login</h3>

            <!-- Pesan Error -->
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" required placeholder="Example@gmail.com">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                </div>

                <!-- Tombol Login -->
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-light text-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Hilangkan alert setelah 4 detik
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // Hapus dari DOM setelah animasi fade
        }
    }, 2000); // 4000 ms = 4 detik
</script>


</body>
</html>
