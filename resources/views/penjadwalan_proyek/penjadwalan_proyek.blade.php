<x-layout>

    <div class="card">
        <div class="card-body">
            <div>
                <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $id_proyek_disetujui]) }}"
                    class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
                    </svg>
                    Kembali
                </a>
            </div>
            <h4 class="card-title mb-3">Penjadwalan Proyek</h4>

            <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Tambah Jadwal (Kiri) -->
                <a class="btn btn-primary d-flex align-items-center px-3 mb-3"
                    href="{{ route('penjadwalan_proyek.create', ['id_proyek_disetujui' => $id_proyek_disetujui]) }}">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Jadwal
                </a>

                <!-- Kolom Pencarian (Kanan) -->
                <div class="input-group mb-3" style="width: 200px;">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Data">
                </div>
            </div>

                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="jadwalTable">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Nama Proyek
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Supervisor
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Tanggal Mulai
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Tanggal Selesai
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Pekerjaan
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                                <th class="text-center text-uppercase  text-xxs font-weight-bolder opacity-7">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                            @foreach ($penjadwalanProyek as $jadwal)
                                <tr>
                                    <td class="text-center text-xs  mb-0">{{ ($penjadwalanProyek->currentPage() - 1) * $penjadwalanProyek->perPage() + $loop->iteration }}</td>
                                    <td class="text-center text-xs  mb-0">
                                        {{ $jadwal->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Diketahui' }}
                                    </td>
                                    <td class="text-center text-xs  mb-0">
                                        {{ $supervisor }}
                                    </td>
                                    <td class="text-center text-xs  mb-0">
                                        {{ date('d-m-Y', strtotime($jadwal->tanggal_mulai)) }}</td>
                                    <td class="text-center text-xs  mb-0">
                                        {{ date('d-m-Y', strtotime($jadwal->tanggal_selesai)) }}</td>
                                    <td class="text-center text-xs  mb-0">{{ $jadwal->pekerjaan }}</td>
                                    <td class="text-center text-xs  mb-0" style="text-transform: capitalize;">
                                        {{ $jadwal->status }}</td>
                                    <td class="text-center text-xs  mb-0">
                                        <a href="/penjadwalan_proyek/edit/{{ $jadwal->id }}?id_proyek_disetujui={{ $id_proyek_disetujui }}"
                                            class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form id="delete-form-{{ $jadwal->id }}"
                                            action="/penjadwalan_proyek/delete/{{ $jadwal->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="hapusJadwal('{{ $jadwal->id }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Baris untuk "Data tidak ditemukan" -->
                            <tr id="noDataRow" style="display: none;">
                                <td colspan="8" class="text-center ">Data tidak ditemukan</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- filepath: d:\proj\simap-pp\resources\views\penjadwalan_proyek\penjadwalan_proyek.blade.php -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap px-2">
                        <div class="d-flex align-items-center">
                            <div class="badge bg-success text-white rounded-pill px-3 py-2 fw-normal">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ $penjadwalanProyek->firstItem() ?? 0 }} - {{ $penjadwalanProyek->lastItem() ?? 0 }}
                                of {{ $penjadwalanProyek->total() ?? 0 }} rows
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="badge bg-success text-white rounded-pill px-3 py-2 fw-normal">
                                <a href="{{ $penjadwalanProyek->appends(['id_proyek_disetujui' => request('id_proyek_disetujui')])->previousPageUrl() }}"
                                    class="btn-sm text-white {{ $penjadwalanProyek->currentPage() == 1 ? 'disabled' : '' }}">
                                    <i class="bi bi-chevron-left"></i> Previous
                                </a>
                                <span class="mx-2">Page {{ $penjadwalanProyek->currentPage() }} of
                                    {{ $penjadwalanProyek->lastPage() }}</span>
                                <a href="{{ $penjadwalanProyek->appends(['id_proyek_disetujui' => request('id_proyek_disetujui')])->nextPageUrl() }}"
                                    class="btn-sm text-white {{ $penjadwalanProyek->currentPage() == $penjadwalanProyek->lastPage() ? 'disabled' : '' }}">
                                    Next <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        function hapusJadwal(id) {
            Swal.fire({
                title: "Hapus Jadwal Proyek",
                html: "Apakah anda yakin akan menghapus jadwal ini? <b>Jadwal yang dihapus tidak dapat dikembalikan lagi.</b>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak, kembali",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + id).submit();
                }
            });
        }

        // Fitur Pencarian (Live Search)
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#jadwalTableBody tr:not(#noDataRow)");
            let noDataRow = document.getElementById("noDataRow");
            let found = false;

            rows.forEach(row => {
                let cells = row.getElementsByTagName("td");
                let rowText = "";
                for (let i = 0; i < cells.length - 1; i++) { // Exclude last cell (actions)
                    rowText += cells[i].textContent + " ";
                }
                rowText = rowText.toLowerCase();

                if (rowText.includes(filter)) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });
            // Tampilkan "Data tidak ditemukan" jika tidak ada hasil
            noDataRow.style.display = found ? "none" : "";
        });
    </script>
</x-layout>
