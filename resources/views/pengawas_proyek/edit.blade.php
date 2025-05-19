<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengawas Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light py-5">

    <div class="container d-flex justify-content-center">
        <div class="card shadow w-50">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Pengawas Proyek</h2>
                
                <!-- Form Edit -->
                <form action="{{ route('pengawas-proyek.update', $pengawas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_proyek" class="form-label">Nama Proyek</label>
                        <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" 
                            value="{{ $pengawas->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="peran" class="form-label">Peran</label>
                        <input type="text" class="form-control" id="peran" name="peran" 
                            value="{{ $pengawas['peran'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pekerja" class="form-label">Nama Pekerja</label>
                        <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" 
                            value="{{ $pengawas->pekerja->nama ?? 'Tidak Ada' }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pengawas-proyek.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
