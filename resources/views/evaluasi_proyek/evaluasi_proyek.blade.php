<x-layout>
    <div class="">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h2 class="mb-4">Evaluasi Proyek</h2>

                <div class="d-flex justify-content-end mb-3" style="align-items: center;">
                    <form action="{{ route('evaluasi.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" class="form-control"
                            style="max-width: 250px; border-radius: 8px;" placeholder="Cari nama proyek"
                            aria-label="Search" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary mt-3" style="border-radius: 8px;">
                            Search
                        </button>
                    </form>
                </div>


                {{-- DATA --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th>Nama Proyek</th>
                                <th>Harga Proyek (Rp)</th>
                                <th>Durasi</th>
                                <th class="text-center">Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyekSelesai as $proyek)
                                <tr>
                                    <td>{{ $proyek->nama_proyek }}</td>
                                    <td>{{ number_format($proyek->harga, 0, ',', '.') }}</td>
                                    <td>{{ $proyek->durasi }} hari</td> {{-- Durasi dihitung dari tanggal_mulai - tanggal_selesai --}}
                                    <td class="text-success text-center">
                                        <strong>{{ strtoupper($proyek->status) }}</strong>
                                    </td>
                                    <td class="{{ empty($proyek->keterangan) ? 'keterangan-belum' : '' }}">
                                        {{ !empty($proyek->keterangan) ? $proyek->keterangan : 'Belum dievaluasi' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('evaluasi.edit', $proyek->id) }}" class="btn btn-success">
                                            <i class="fas fa-clipboard-check"></i> Evaluasi
                                        </a>
                                        <a href="{{ route('detail', $proyek->id_proyek) }}" class="btn btn-warning">
                                            <i class="fas fa-file-alt"></i> Laporan
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
