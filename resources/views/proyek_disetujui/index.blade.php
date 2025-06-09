<x-layout>
    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white">
            <h2>Proyek Disetujui</h2>
            <!-- Form Search -->
            <div class="d-flex justify-content-end mb-2">
                <input type="text" id="searchInput" class="search-box" placeholder="Cari Proyek..."
                       onkeyup="searchTable()"
                       style="width: 250px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;">

            </div>

            {{-- DATA --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm mb-2">
                    <thead class="table-secondary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Proyek</th>
                        <th class="text-center">Tempat Proyek</th>
                        <th class="text-center">Harga Proyek (Rp)</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal Mulai</th>
                        <th class="text-center">Tanggal Selesai</th>
                        <th class="text-center" width="50">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proyek as $key => $item)
                        <tr>
                            <td class="text-center">{{ ($proyek->currentPage() - 1) * $proyek->perPage() + $loop->iteration }}</td>
                            <td class="text-center">{{ $item->pengajuanProposal->nama_proyek }}</td>
                            <td class="text-center">{{ $item->pengajuanProposal->tempatProyek->nama_tempat }}
                            </td>
                            <td class="text-center">
                                {{ number_format($item->pengajuanProposal->harga, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->tanggal_mulai }}</td>
                            <td class="text-center">{{ $item->tanggal_selesai }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="d-flex gap-1">
                                    @if ($item->status != 'Batal')
                                        <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $item->id]) }}"
                                           class="btn text-white" style="background-color: #007BFF;">
                                            <i class="bi bi-eye-fill text-white"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('proyekdisetujui.show', $item->id) }}" class="btn text-white"
                                       style="background-color: #17a2b8;">
                                        <i class="bi bi-info-circle-fill text-white"></i>
                                    </a>
                                    <a href="{{ route('proyekdisetujui.edit', $item->id) }}" class="btn text-white"
                                       style="background-color: #DEAA00;">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-0 mb-3 flex-wrap px-1">
                    <div class="d-flex align-items-center">
                        <div class="badge bg-success text-white rounded-pill px-3 py-2 fw-normal">
                            <i class="bi bi-info-circle me-1"></i>
                            {{ $proyek->firstItem() ?? 0 }} - {{ $proyek->lastItem() ?? 0 }}
                            of {{ $proyek->total() ?? 0 }} rows
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="badge bg-success text-white rounded-pill px-3 py-2 fw-normal">
                            <a href="{{ $proyek->previousPageUrl() }}"
                               class="btn-sm text-white {{ $proyek->currentPage() == 1 ? 'disabled' : '' }}">
                                <i class="bi bi-chevron-left"></i> Previous
                            </a>
                            <span class="mx-2">Page {{ $proyek->currentPage() }} of
                                    {{ $proyek->lastPage() }}</span>
                            <a href="{{ $proyek->nextPageUrl() }}"
                               class="btn-sm text-white {{ $proyek->currentPage() == $proyek->lastPage() ? 'disabled' : '' }}">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-layout>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Notifikasi Sukses -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<script>
    function searchTable() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let rows = document.querySelectorAll("tbody tr");
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
