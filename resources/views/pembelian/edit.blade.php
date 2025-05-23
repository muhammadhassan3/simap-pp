<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pembelian</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="card shadow mb-5 rounded">
            <div class="card-header">
                <h2 class="mb-3">Edit Pembelian</h2>
                <div class="card-body">
                    <a href="/pembelian" class="btn btn-primary">Kembali</a>

                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" class="mb-4"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pembelian->tanggal }}" required>
                        </div>

                        <div class="form-group">
                            <label for="no_nota">No Nota</label>
                            <input type="text" class="form-control" id="no_nota" name="no_nota" value="{{ $pembelian->no_nota }}" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_nota">Upload Nota</label>
                            <input type="file" class="form-control" id="foto_nota" name="foto_nota" value="{{ $pembelian->foto_nota }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_proyek">Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{ $pembelian->nama_proyek }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke JS Bootstrap (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
