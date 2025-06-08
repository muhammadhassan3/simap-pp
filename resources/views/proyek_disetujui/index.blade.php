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
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Tempat Proyek</th>
                            <th>Harga Proyek</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th width="50">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyek as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $item->pengajuanProposal->nama_proyek }}</td>
                                <td class="text-center">{{ $item->pengajuanProposal->tempatProyek->nama_tempat }}
                                </td>
                                <td class="text-center">Rp
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
