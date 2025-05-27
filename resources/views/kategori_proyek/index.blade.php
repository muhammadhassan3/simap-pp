<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div class="d-flex align-items-center mb-3">
                    <h3 class="text-start">Kategori Proyek</h3>
                </div>

                <div class="row mb-3 pt-2">
                    <div class="col-md-3">
                        <!-- Tombol Tambah -->
                        <a href="{{ route('kategori_proyek.create') }}" class="btn btn-primary">+ Tambah Kategori Proyek</a>
                    </div>
                    <div class="col-md-9">
                        <!-- Search Form -->
                        <form action="{{ route('kategori_proyek.index') }}" method="GET"
                            class="w-100 d-flex justify-content-end">
                            <div class="input-group shadow-sm" style="max-width: 350px; height: 40px;">
                                <input type="text" id="searchInput" name="search" class="form-control"
                                    style="height: 40px; border-radius: 0.375rem 0.375rem 0.375rem 0.375rem !important;"
                                    placeholder="Cari kategori proyek ..." onkeyup="searchTable()">
                            </div>
                        </form>

                    </div>
                </div>

                <div class="table-responsive pt-2">
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>NAMA KATEGORI</th>
                                <th>KETERANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="text-start">
                            @foreach ($kategoris as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td> <!-- Gunakan index biasa -->
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <!-- Edit -->
                                        <a href="{{ route('kategori_proyek.edit', $item->id) }}" class="btn btn-sm"
                                            style="background-color: #DEAA00;">
                                            <img style="width: 18px;"
                                                src="https://img.icons8.com/?size=100&id=86374&format=png&color=FFFFFF"
                                                alt="Hapus">
                                        </a>

                                        <!-- Hapus -->
                                        <a href="javascript:void(0);" class="btn btn-sm text-white"
                                            style="background-color: #DE3F00;"
                                            data-url="{{ route('kategori_proyek.destroy', $item->id) }}"
                                            onclick="showDeleteModal(this)">
                                            <img style="width: 18px;"
                                                src="https://img.icons8.com/?size=100&id=DU8dSXkvLUkx&format=png&color=FFFFFF"
                                                alt="Hapus">
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
    @include('kategori_proyek.delete')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
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
</x-layout>
