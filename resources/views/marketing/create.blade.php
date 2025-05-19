<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketing Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <div class="content container mt-4">
            <h2 class="mb-4">Tambah Marketing</h2>

            <form action="{{ route('market.store') }}" method="POST">
                @csrf

                <!-- Nama Produk & Nama Customer -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer" class="form-label">Nama Customer</label>
                        <select class="form-select" name="customer_id">
                            <option value="">-- Pilih Customer --</option>
                            @foreach ($customer as $c)
                                <option value="{{ $c['id'] }}">{{ $c['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="produk" class="form-label">Nama Produk</label>
                        <select class="form-select" name="produk_id">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p['id'] }}">{{ $p['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tujuan Pembelian -->
                <div class="mb-3">
                    <label for="tujuan" class="form-label">Tujuan Pembelian</label>
                    <textarea class="form-control" name="tujuan_pembelian" id="tujuan"></textarea>
                </div>

                <!-- Jenis Pembayaran & Keterangan Pembayaran -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                        <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran">
                            <option value="">-- Pilih Jenis Pembayaran --</option>
                            <option value="Tunai">Tunai</option>
                            <option value="DP">DP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                        <input type="text" class="form-control" name="keterangan_pembayaran" id="keterangan">
                    </div>
                </div>

                <!-- Tanggal Pembelian -->
                <div class="mb-3">
                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                    <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian"
                        onclick="this.showPicker()">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>



    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
