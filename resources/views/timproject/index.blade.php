<x-layout>
    @if (session('success'))
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

    <div class="card mb-4">
        <div class="card-body pb-4">
            <h2 class="mb-3">Tim Proyek</h2>

            <!-- Tombol Tambah -->
            <div class="mb-3">
                <a href="{{ route('tim-proyek.create') }}" class="btn btn-primary">+ Tambah Tim Proyek</a>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>Tempat Proyek</th>
                            <th>Nama Proyek</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timProyek->unique('id_project_disetujui') as $tim)
                            <tr>
                                <td>
                                    @if (
                                        $tim->proyekDisetujui &&
                                            $tim->proyekDisetujui->pengajuan_proposal &&
                                            $tim->proyekDisetujui->pengajuan_proposal->tempat_proyek)
                                        {{ $tim->proyekDisetujui->pengajuan_proposal->tempat_proyek->nama_tempat }}
                                    @else
                                        Data tidak tersedia
                                    @endif
                                </td>
                                <td>
                                    @if ($tim->proyekDisetujui && $tim->proyekDisetujui->pengajuan_proposal)
                                        {{ $tim->proyekDisetujui->pengajuan_proposal->nama_proyek }}
                                    @else
                                        Data tidak tersedia
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($tim->proyekDisetujui)
                                        <a href="{{ route('tim-proyek.detail', $tim->proyekDisetujui->id) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Detail</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
