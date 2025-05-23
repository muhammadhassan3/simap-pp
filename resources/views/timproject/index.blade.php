<x-layout>
    @if(session('success'))
    <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(() => {
            let alertBox = document.getElementById("alert-success");
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500); // Hapus elemen setelah animasi
            }
        }, 3000);
    </script>
    @endif

    <div class="container">
        <h2 class="mb-3">Tim Proyek</h2>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="{{ route('tim-proyek.create') }}" class="btn btn-primary">+ Tambah Tim Proyek</a>
        </div>

        <!-- Tabel Data -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tempat Proyek</th>
                            <th>Nama Proyek</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timProyek->unique('proyek_disetujui') as $tim)
                        <tr>
                            <td>{{ $tim->proyek_disetujui->pengajuan_proposal->tempat_proyek->nama }}</td>
                            <td>{{ $tim->proyek_disetujui->pengajuan_proposal->nama_proyek }}</td>
                            <td class="text-center">
                                <a href="{{ route('tim-proyek.detail', $tim->proyek_disetujui->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
