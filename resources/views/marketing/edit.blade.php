<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketing Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            width: 220px;
            /* Sidebar memiliki lebar tetap */
            background-color: #f8f9fa;
            /* Warna background */
            border-right: 2px solid #ddd;
            /* Tambahkan garis pembatas di sisi kanan */
        }

        .content {
            margin-left: 220px;
            /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
            width: calc(100% - 220px);
            /* Agar fleksibel di berbagai ukuran layar */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light shadow-sm p-3">
        <div class="container-fluid d-flex justify-content-end">
            <span class="me-3">Admin</span>
            <button class="btn btn-outline-secondary">🔔</button>
        </div>
    </nav>

    <!-- Wrapper untuk Sidebar dan Konten -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-light col-md-2 p-3 shadow-sm">
            <div class="text-center">
                <img src="https://i.ibb.co.com/1fdQ7L6k/logo-pt-isla.png" alt="Logo" height="40">
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item"><a class="nav-link active" href="#">🏠 Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">📍 Tempat Proyek</a></li>
                <li class="nav-item"><a class="nav-link" href="#">📝 Proposal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">📦 Project Diterima</a></li>
                <li class="nav-item"><a class="nav-link" href="#">📊 Produk</a></li>
                <hr>
                <li class="nav-item"><a class="nav-link" href="#">👤 User</a></li>
            </ul>
        </div>

        <!-- Konten Utama -->
        <div class="content container mt-4">
            <h2 class="mb-4">Edit Marketing</h2>

            <form action="{{ route('market.update', $marketing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Produk & Nama Customer -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer" class="form-label">Nama Customer</label>
                        <select class="form-select" name="customer_id">
                            <option value="">-- Pilih Customer --</option>
                            @foreach ($customer as $c)
                                <option value="{{ $c->id }}"
                                    {{ $c->id == $marketing->customer_id ? 'selected' : '' }}>
                                    {{ $c->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="produk" class="form-label">Nama Produk</label>
                        <select class="form-select" name="produk_id">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id }}"
                                    {{ $p->id == $marketing->produk_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tujuan Pembelian -->
                <div class="mb-3">
                    <label for="tujuan" class="form-label">Tujuan Pembelian</label>
                    <textarea class="form-control" name="tujuan_pembelian" id="tujuan">{{ $marketing->tujuan_pembelian }}</textarea>
                </div>

                <!-- Jenis Pembayaran & Keterangan Pembayaran -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                        <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran">
                            <option value="Tunai" {{ $marketing->jenis_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai
                            </option>
                            <option value="DP" {{ $marketing->jenis_pembayaran == 'DP' ? 'selected' : '' }}>DP
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                        <input type="text" class="form-control" name="keterangan_pembayaran" id="keterangan"
                            value="{{ $marketing->keterangan_pembayaran }}">
                    </div>
                </div>

                <!-- Tanggal Pembelian -->
                <div class="mb-3">
                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                    <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian"
                        value="{{ $marketing->tanggal_pembelian }}" onclick="this.showPicker()">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('market.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>


    </div>
    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successToast = document.getElementById('successToast');
            if (successToast && successToast.querySelector('.toast-body').textContent.trim() !== '') {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
