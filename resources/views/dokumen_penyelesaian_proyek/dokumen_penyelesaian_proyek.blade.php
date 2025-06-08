<x-layout>
    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white">
            <h2>Dokumen Penyelesaian Proyek</h2>

            {{-- Bar Atas: Tombol + Pencarian --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="d-flex gap-2">
                    <a href="{{ route('dokumen.create') }}" class="btn btn-primary m-0">
                        <i class="bi bi-plus"></i> Tambah Dokumen
                    </a>
                </div>

                <form action="{{ route('dokumen.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Proyek"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary shadow-sm m-0 d-flex align-items-center gap-2">
                        <i class="bi bi-search"></i> <span>Cari</span>
                    </button>
                    <a href="{{ route('dokumen.index') }}" class="btn btn-secondary m-0"><i
                            class="bi bi-x-circle"></i></a>
                </form>
            </div>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Proyek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Dokumen</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Keterangan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($dokumen as $index => $data)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada Data' }}
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $data->file) }}" target="_blank"
                                        class="btn bg-gradient-info mb-1">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat Dokumen
                                    </a>
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td>{{ $data->created_at->format('d M Y') }}</td>
                                <td>


                                    <!-- Edit Dokumen -->
                                    <form action="{{ route('dokumen.edit', $data->id) }}" method="GET"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"><i
                                                class="bi bi-pencil"></i></button>
                                    </form>

                                    <!-- Hapus Dokumen dengan Konfirmasi SweetAlert -->
                                    <button type="submit" class="btn btn-danger"
                                        onclick="confirmDelete({{ $data->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $data->id }}"
                                        action="{{ route('dokumen.destroy', $data->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada dokumen
                                    penyelesaian
                                    yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            @push('scripts')
                <!-- SweetAlert untuk Konfirmasi Hapus -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function confirmDelete(id) {
                        Swal.fire({
                            title: "Apakah Anda yakin?",
                            text: "Data yang dihapus tidak bisa dikembalikan!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!",
                            cancelButtonText: "Batal"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('delete-form-' + id).submit();
                            }
                        });
                    }
                </script>
            @endpush


        </div>
    </div>

</x-layout>
