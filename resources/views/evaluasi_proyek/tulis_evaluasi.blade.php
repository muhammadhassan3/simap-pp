<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 800px; /* Lebar disesuaikan */
            margin: 40px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-back {
            font-size: 16px;
            text-decoration: none;
            color: black;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .form-control {
            background-color: #f1f3f5;
            border: none;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn-save {
            background-color: rgb(28, 154, 226);
            color: white;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
        }
        .btn-save:hover {
            background-color: #00a2ff;
        }
    </style>
</head>
<body>

    <div class="container-box">
        <a href="{{ route('evaluasi.index') }}" class="btn-back">← Kembali ke Evaluasi</a>

        <h5 class="mt-3">Nama Proyek</h5>
        <input type="text" class="form-control" value="{{ $proyek->proyekDisetujui->pengajuanProposal->nama_proyek }}" readonly>

        <h5 class="mt-3">Tulis Evaluasi</h5>
        <form action="{{ route('evaluasi.update', $proyek->id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="keterangan" class="form-control mt-2" rows="4" placeholder="Tulis evaluasi di sini...">{{ $proyek->keterangan }}</textarea>
            
            <button type="submit" class="btn-save mt-3">Simpan</button>
        </form>
    </div>

</body>
</html>
