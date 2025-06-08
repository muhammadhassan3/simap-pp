<x-layout>
    <div class="card mb-4">
        <div class="card-body">
            <h2>Kategori</h2>

            <div class="d-flex justify-content-between align-items-center" style="margin-top: 20px; margin-bottom: 20px;">
                <!-- Tombol Tambah -->
                <a href="{{ route('kategori_proyek.create') }}" class="btn btn-primary m-0">+ Tambah Kategori</a>

                <!-- Search Form -->
                <form action="{{ route('kategori_proyek.index') }}" method="GET"
                class="input-group w-auto ">
                    <div class="input-group shadow-sm" style="input-group w-auto ">
                        <input type="text" id="searchInput" name="search" class="form-control"
                            placeholder="Cari kategori proyek ..." onkeyup="searchTable()">
                    </div>
                </form>
            </div>


            <div class="table-responsive">
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
                                <td class="text-center align-middle" style="vertical-align: middle;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <!-- Edit -->
                                        <a href="{{ route('kategori_proyek.edit', $item->id) }}"
                                            class="btn align-middle"
                                            style="background-color: #efb944; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                            <img style="width: 18px; height: 18px; vertical-align: middle;"
                                                src="https://img.icons8.com/?size=100&id=86374&format=png&color=FFFFFF"
                                                alt="Edit">
                                        </a>

                                        <!-- Delete -->
                                        <button type="button" class="btn btn-edit align-middle" data-bs-toggle="modal"
                                            data-bs-target="#deleteKategori" data-id="{{ $item->id }}"
                                            data-nama="{{ $item->nama }}"
                                            style="background-color: #ef4444; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                            <img style="width: 18px; height: 18px; vertical-align: middle;"
                                                src="https://img.icons8.com/?size=100&id=DU8dSXkvLUkx&format=png&color=FFFFFF"
                                                alt="Hapus">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('kategori_proyek.delete') --}}

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteKategori" tabindex="-1" aria-labelledby="deleteKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="deleteKategoriLabel">Hapus Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteKategoriForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="delete_id" name="id">
                        <p>Apakah Anda yakin ingin menghapus <span id="delete_nama" class="fw-bold"></span>?</p>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 10px; padding: 10px 24px;">Batal</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger"
                        style="border-radius: 10px; padding: 10px 24px;">Hapus</button>
                </div>
            </div>
        </div>
    </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-edit');
            const deleteForm = document.getElementById('deleteKategoriForm');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('delete_id').value = id;
                    deleteForm.action = `/kategori_proyek/${id}`;
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.submit();
            });
        });
    </script>
</x-layout>
