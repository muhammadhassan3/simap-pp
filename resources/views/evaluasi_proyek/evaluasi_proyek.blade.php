<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .status-selesai {
            color: green;
            font-weight: bold;
        }
        .btn-evaluasi {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: bold;
            padding: 4px 10px; /* Ukuran tombol diperkecil */
            border-radius: 6px;
            text-transform: uppercase;
            font-size: 14px; /* Ukuran font disesuaikan */
        }
        .btn-evaluasi-green {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .btn-evaluasi-gray {
            background-color: gray;
            color: white;
            border: none;
        }
        td.keterangan-belum {
            color: red !important;
            font-weight: bold;
        }


    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Evaluasi Proyek</h2>

        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('evaluasi.index') }}" method="GET" class="d-flex">
                <input class="form-control me-2 w-70" type="search" name="search" placeholder="Cari nama proyek" aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyekSelesai as $proyek)
                <tr>
                    <td>{{ $proyek->nama_proyek }}</td>
                    <td class="text-success"><strong>{{ strtoupper($proyek->status) }}</strong></td>
                    <td class="{{ empty($proyek->keterangan) ? 'keterangan-belum' : '' }}">
                        {{ !empty($proyek->keterangan) ? $proyek->keterangan : 'Belum dievaluasi' }}
                    </td>
                    
                    <td>
                        <a href="{{ route('evaluasi.edit', $proyek->id) }}" class="btn btn-success">
                            <i class="fas fa-pencil"></i> Evaluasi
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</body>
</html>
