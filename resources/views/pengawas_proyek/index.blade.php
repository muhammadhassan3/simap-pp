<x-layout>
    <div class="container d-flex justify-content-center">
        <div class="card shadow w-100">
            <div class="card-body">
                <h4 class="card-title text-left mb-4">Pengawas Proyek</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('pengawas-proyek.create') }}" class="btn btn-primary">
                            + Tambah Pengawas Proyek
                        </a>
                    </div>

                    <div class="input-group w-30">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                    </div>
                </div>

                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA PROYEK</th>
                            <th class="text-center">PERAN</th>
                            <th class="text-center">NAMA PEKERJA</th>
                            <th class="text-center">KEAHLIAN</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        @foreach ($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $item['nama_proyek'] }}</td>
                                <td class="text-center">{{ $item['peran'] }}</td>
                                <td class="text-center">{{ $item['nama_pekerja'] }}</td>
                                <td class="text-center">{{ $item['keahlian'] }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pengawas-proyek.edit', $item['id']) }}"
                                        class="btn btn-warning px-2 py-1">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                    <button class="btn btn-danger px-2 py-1" data-bs-toggle="modal"
                                        data-bs-target="#deletePengawas" data-id="{{ $item['id'] }}"
                                        data-nama="{{ $item['nama_pekerja'] }}">
                                        <i class="bi bi-trash-fill text-white"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deletePengawas" tabindex="-1" aria-labelledby="deletePengawasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="deletePengawasLabel">Hapus Pekerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deletePengawasForm" method="POST">
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

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('button[data-bs-target="#deletePengawas"]');
            const deleteForm = document.getElementById('deletePengawasForm');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    document.getElementById('delete_id').value = id;
                    document.getElementById('delete_nama').innerText = nama;
                    deleteForm.action = `/pengawas-proyek/${id}/delete`;
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.submit();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
