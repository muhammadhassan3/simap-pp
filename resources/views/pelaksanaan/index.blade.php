<x-layout>

    <div class="w-full p-3 bg-white" style="border-radius: 20px;">
        <!-- Button Kembali -->
        <div>
            <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $penjadwalan->id_proyek_disetujui]) }}" class="btn btn-outline-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
                </svg>
                Kembali
            </a>
        </div>


        <h5 class="text-dark fw-semibold mb-3">Pelaksanaan Proyek</h5>

        <div class="row g-2">
            <div class="col-12 col-md-4">
                <div class="p-3 text-white shadow rounded" style="background: #007ADE;">
                    <h6 class="fw-bold text-white mb-1">Pekerjaan</h6>
                    <p class="small mb-0">{{ $penjadwalan->pekerjaan }}</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-3 text-white shadow rounded" style="background: #007ADE;">
                    <h6 class="fw-bold text-white mb-1">Nama Proyek</h6>
                    <p class="small mb-0">{{ $penjadwalan->proyekDisetujui->pengajuanProposal->nama_proyek }}</p>
                    <p class="small mb-0">{{ $penjadwalan->proyekDisetujui->pengajuanProposal->nama_proyek }}</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-3 text-white shadow rounded" style="background: #007ADE;">
                    <h6 class="fw-bold text-white mb-1">Timeline</h6>
                    <p class="small mb-0">
                        {{ \Carbon\Carbon::parse($penjadwalan->tanggal_mulai)->format('d-m-Y') }} s/d
                        {{ \Carbon\Carbon::parse($penjadwalan->tanggal_selesai)->format('d-m-Y') }}
                        ({{ \Carbon\Carbon::parse($penjadwalan->tanggal_mulai)->diffInDays($penjadwalan->tanggal_selesai) % 30 }}
                        hari)
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-1">
            <!-- Button Tambah -->
            <a href="{{ route('pelaksanaan.create', $penjadwalan->id) }}" class="btn text-white shadow-sm mt-3"
                style="background-color: #007ADE;">
                Tambah
            </a>

            <!-- Search Bar -->
            <div class="position-relative" style="max-width: 300px;">
                <form action="{{ route('pelaksanaan.index', $penjadwalan->id) }}" method="GET">
                    <input type="text" class="form-control form-control-sm pe-5" style="height: 40px;"
                        placeholder="Cari..." aria-label="Search" name="search" value="{{ request('search') }}">
                    <button
                        class="btn position-absolute top-50 end-2 translate-middle-y d-flex align-items-center justify-content-center"
                        type="submit" style="height: 30px; width: 30px; padding: 0; background-color: #007ADE;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search text-white" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Note --}}
        <div class="alert d-flex align-items-center text-white gap-2" style="background-color: #007ADE" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path
                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
            </svg>
            <div>
                <strong>Note!</strong> Centang pelaksanaan jika sudah sesuai dengan di lapangan.
            </div>
        </div>


        {{-- Table Pelaksanaan --}}
        <div class="mt-1">
            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th>Nama Pelaksanaan</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelaksanaan as $x => $data)
                            <tr
                                class="text-center {{ $data->status == 'Dikonfirmasi' ? 'bg-success text-white' : '' }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($data->tanggal_pelaksanaan)->format('d M Y') }}</td>
                                <td>{{ $data->nama_pelaksanaan }}</td>
                                <td class="text-center">
                                    <a href="{{ $data->foto ? asset('storage/' . $data->foto) : 'https://via.placeholder.com/50' }}"
                                        target="_blank">
                                        <img src="{{ $data->foto ? asset('storage/' . $data->foto) : 'https://via.placeholder.com/50' }}"
                                            alt="Foto" class="rounded img-thumbnail" width="50" height="50">

                                    </a>
                                </td>
                                <td class="text-start">{{ $data->keterangan }}</td>
                                <td class="text-center">
                                    @if ($data->status != 'Dikonfirmasi')
                                        <!-- Sembunyikan tombol jika sudah dikonfirmasi -->
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('pelaksanaan.edit', ['id' => $data->id_penjadwalan, 'kode' => $data->id]) }}"
                                            class="btn btn-outline-warning btn-sm" style="padding-inline: 1rem">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill " viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                        </a>

                                        <!-- Tombol Delete -->
                                        <button class="btn btn-outline-danger btn-sm" style="padding-inline: 1rem"
                                            onclick="confirmDelete({{ $data->id }}, '{{ $data->id_penjadwalan }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>

                                        <!-- Form Delete -->
                                        <form id="delete-form-{{ $data->id }}"
                                            action="{{ route('pelaksanaan.destroy', ['id' => $data->id, 'kode' => $data->id_penjadwalan]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Tombol Centang -->
                                        <button class="btn btn-outline-danger btn-sm"
                                            style="padding-inline: 1rem; border-color: #5CB338; color: #5CB338;"
                                            onclick="confirmChecked({{ $data->id }}, '{{ $data->id_penjadwalan }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-lg" style="color: #5CB338"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                            </svg>
                                        </button>

                                        <!-- Form untuk mengubah status -->
                                        <form id="checked-form-{{ $data->id }}"
                                            action="{{ route('pelaksanaan.confirm', ['id' => $data->id_penjadwalan, 'kode' => $data->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function confirmChecked(id, kode) {
            Swal.fire({
                title: "Konfirmasi Pelaksanaan?",
                text: "Apakah Anda yakin ingin mengkonfirmasi pelaksanaan ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#5CB338",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`checked-form-${id}`).submit();
                }
            });
        }

        function confirmFinish(id, kode) {
            Swal.fire({
                title: "Apakah Sudah Selesai?",
                text: "Apakah Anda yakin ingin menyelesaikan pelaksanaan ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#5CB338",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Selesai!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`finish-form-${id}`).submit();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</x-layout>
