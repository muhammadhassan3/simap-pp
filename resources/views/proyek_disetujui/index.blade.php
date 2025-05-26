<x-layout>
    <div class="mb-3">
        <h3 class="font-weight-bold text-md">Proyek Disetujui</h3>
    </div>

    <!-- Form Search -->
    <div class="d-flex justify-content-end mb-4">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari Proyek..." onkeyup="searchTable()"
            style="width: 250px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;">

    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0 text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>NO</th>
                        <th>NAMA PROYEK</th>
                        <th>TEMPAT PROYEK</th>
                        <th>HARGA PROYEK</th>
                        <th>STATUS</th>
                        <th>TANGGAL MULAI</th>
                        <th>TANGGAL SELESAI</th>
                        <th width="50">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyek as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->pengajuanProposal->nama_proyek }}</td>
                            <td>{{ $item->pengajuanProposal->tempatProyek->nama_tempat }}</td>
                            <td>Rp {{ number_format($item->pengajuanProposal->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $item->id]) }}"
                                        class="btn btn-sm text-white" style="background-color: #007BFF;">
                                        <i class="bi bi-eye-fill text-white"></i>
                                    </a>
                                    <a href="{{ route('proyekdisetujui.show', $item->id) }}"
                                        class="btn btn-sm text-white" style="background-color: #17a2b8;">
                                        <i class="bi bi-info-circle-fill text-white"></i>
                                    </a>
                                    <a href="{{ route('proyekdisetujui.edit', $item->id) }}"
                                        class="btn btn-sm text-white" style="background-color: #DEAA00;">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

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
