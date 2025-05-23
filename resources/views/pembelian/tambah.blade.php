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
                <a href="/pembelian" class="text-dark mr-3"><i class="fas fa-arrow-left"></i></a>
                <h4 class="mb-0">Tambah Data Pembelian</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pembelian.simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="tanggal">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="no_nota">No Nota</label>
                        <input type="text" class="form-control" id="no_nota" name="no_nota" required
                            placeholder="Masukkan No Nota">
                        <input type="text" class="form-control" id="no_nota" name="satuan_list" hidden>

                        <div class="form-group">
                            <label for="foto_nota">Upload Nota</label>
                            <input type="file" class="form-control" id="foto_nota" name="foto_nota" required>
                        </div>

                        <div class="form-group">
                            <label for="id_proyek_disetujui">Nama Proyek</label>
                            <select class="form-control" name="id_proyek_disetujui" id="id_proyek_disetujui" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyekDisetujui as $proyek)
                                    <option value="{{ $proyek->id }}">
                                        {{ $proyek->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @livewire(DetailPembelian::class)

                        <button type="submit" class="btn btn-primary">Tambah Pembelian</button>

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
