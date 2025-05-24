<x-layout>
    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <a href="{{ route('proyekdisetujui.index') }}" class="text-dark text-decoration-none">
                <h5 class="fw-bold">
                    <i class="bi bi-arrow-left"></i> Detail Proyek
                </h5>
            </a>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th class="bg-light">Nama Proyek</th>
                            <td>{{ $proyek->pengajuan_proposal->nama_proyek }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tempat Proyek</th>
                            <td>{{ $proyek->pengajuan_proposal->tempat_proyek->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Harga Proyek</th>
                            <td>Rp. {{ number_format($proyek->pengajuan_proposal->harga, 0, ',', '.') }}</Rp.>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Proposal Proyek</th>
                            <td>
                                <a href="{{ asset('proposal/' . $proyek->pengajuan_proposal->file_proposal) }}"
                                    target="_blank" class="text-primary fw-bold">
                                    <i class="fas fa-file-pdf text-danger"></i>
                                    {{ $proyek->pengajuan_proposal->file_proposal }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                {{ $proyek->status }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Mulai</th>
                            <td>{{ $proyek->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Selesai</th>
                            <td>{{ $proyek->tanggal_selesai }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
