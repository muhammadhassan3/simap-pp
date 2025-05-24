<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Pembelian' }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @livewireScripts
    @livewireStyles
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            background: white;
            border-bottom: none;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
            font-size: 16px;
            background-color: #f1f3f5;
            border: none;
        }

        .form-control:focus {
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 8px;
            font-size: 18px;
            padding: 12px;
            width: 100%;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow mb-5">
            <div class="card-header d-flex align-items-center">
                <a href="{{ route('pembelian.detail', $detail->id_pembelian) }}" class="text-dark mr-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h4 class="mb-0">Edit Detail Pembelian</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pembelian.update', $detail->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                            value="{{ $detail->nama_produk }}" required>
                    </div>

                    <div class="form-group">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" name="satuan" required>
                            <option value="" disabled {{ $detail->satuan == '' ? 'selected' : '' }}>--Pilih
                                Satuan--</option>
                            <option value="pcs" {{ $detail->satuan == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="kg" {{ $detail->satuan == 'kg' ? 'selected' : '' }}>Kg</option>
                            <option value="ton" {{ $detail->satuan == 'ton' ? 'selected' : '' }}>Ton</option>
                            <option value="liter" {{ $detail->satuan == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="box" {{ $detail->satuan == 'box' ? 'selected' : '' }}>Box</option>
                        </select>
                    </div>
                    <div class="form-group me-2">
                        <label for="qty" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="qty" name="qty"
                            value="{{ $detail->qty }}" min="0" required>
                    </div>
                    <div class="form-group me-2">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan"
                            value="{{ number_format($detail->harga_satuan, 0, ',', '.') }}" required>
                    </div>
                    <div class="form-group me-2">
                        <label for="total_harga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                            value="{{ number_format($detail->total_harga, 0, ',', '.') }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke JS Bootstrap (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
