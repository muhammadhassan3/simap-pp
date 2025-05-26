<x-layout>
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
                        <a href="{{ route('laporan-proyek', ['id_proyek' => $proyek->id_proyek]) }}" class="btn btn-warning">
                            <i class="fas fa-pencil"></i> Laporan
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
