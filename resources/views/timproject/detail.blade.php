<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $id]) }}"
                    class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
                    </svg>
                    Kembali
                </a>
                <h2 class="mb-3">Detail Tim Proyek</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('tim-proyek.create', ['id_project_disetujui' => $id]) }}" class="btn btn-primary">+ Tambah Tim Proyek</a>
            <!-- Form Pencarian -->
            <form action="{{ route('tim-proyek.detail', ['id' => $id]) }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama pekerja..." style="height: 40px;">
                    <button type="submit" class="btn btn-primary" style="height: 40px;">Cari</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead class="text-secondary">
                        <tr>
                            <th>Nama Pekerja</th>
                            <th>Peran</th>
                            <th>Keahlian</th>
                            <th class="text-center" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tim as $t)
                        <tr>
                            <td>{{ $t->pekerja->nama }}</td>
                            <td class="text-capitalize">{{ $t->peran }}</td>
                            <td>{{ $t->keahlian }}</td>
                            <td class="text-center">
                                <a href="{{ route('tim-proyek.edit', $t->id) }}" class="btn btn-warning btn-md rounded-2 px-3 py-2">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('tim-proyek.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tim ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md rounded-2 px-3 py-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada hasil ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
