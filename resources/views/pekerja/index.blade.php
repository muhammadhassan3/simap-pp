<x-layout>
    <style>
        .pagination .page-link {
            border-radius: 10px !important;
            color: #0d6efd;
            border: 1px solid #dee2e6;
        }

        .pagination .page-link:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.1rem rgba(13, 110, 253, 0.25);
        }

        .pagination .active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .small.text-muted {
            margin-right: 15px;
        }
    </style>

    <div class="card mb-4">
        <div class="card-body">
            <h2>Daftar Pekerja</h2>


            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3 gap-3">
                <a href="{{ route('pekerja.create') }}"
                    class="mt-3 btn text-white text-decoration-none d-flex align-items-center"
                    style="background-color: #007ADE; border-radius: 10px; padding: 0 24px; height: 46px; font-size: 14px;">
                    Tambah Pekerja
                </a>

                <input type="text" class="form-control"
                    style="border-radius: 10px; border: 1px solid #dee2e6; padding: 0 24px; height: 46px; width: 300px"
                    placeholder="Cari pekerja..." id="searchInput">
            </div>

            <div style="overflow-x: auto; border-radius: 12px; border: 1px solid #dee2e6;">
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif;">
                    <thead style="background-color: #f1f5f9;">
                        <tr>
                            <th
                                style="padding: 14px; text-align: center; font-weight: 600; border-bottom: 1px solid #dee2e6;">
                                No</th>
                            <th
                                style="padding: 14px; text-align: left; font-weight: 600; border-bottom: 1px solid #dee2e6;">
                                Nama Pekerja</th>
                            <th
                                style="padding: 14px; text-align: left; font-weight: 600; border-bottom: 1px solid #dee2e6;">
                                No. Telepon</th>
                            <th
                                style="padding: 14px; text-align: center; font-weight: 600; border-bottom: 1px solid #dee2e6;">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="workerTableBody">
                        @foreach ($pekerja as $index => $p)
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px; text-align: center;">
                                    {{ ($pekerja->currentPage() - 1) * $pekerja->perPage() + $index + 1 }}
                                </td>
                                <td style="padding: 12px;">
                                    <div style="font-weight: 500; color: #1e293b;">{{ $p->nama }}</div>
                                </td>
                                <td style="padding: 12px;">
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <span style="font-weight: 500;">{{ $p->no_hp }}</span>
                                    </div>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <a href="{{ route('pekerja.edit', $p->id) }}" class="btn-edit"
                                            style="background-color: #efb944; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer;">
                                            <img style="width: 18px;"
                                                src="https://img.icons8.com/?size=100&id=86374&format=png&color=FFFFFF"
                                                alt="Hapus">
                                        </a>
                                        <button type="button" class="btn-edit" data-bs-toggle="modal"
                                            data-bs-target="#deletePekerjaModal" data-id="{{ $p->id }}"
                                            data-nama="{{ $p->nama }}"
                                            style="background-color: #ef4444; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer;">
                                            <img style="width: 18px;"
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

            <div class="d-flex justify-content-end mt-4">
                {{ $pekerja->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>


        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deletePekerjaModal" tabindex="-1" aria-labelledby="deletePekerjaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="deletePekerjaModalLabel">Hapus Pekerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deletePekerjaForm" method="POST">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#workerTableBody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const phone = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.includes(searchTerm) || phone.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-edit');
            const deleteForm = document.getElementById('deletePekerjaForm');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('delete_id').value = id;
                    deleteForm.action = `/pekerja/${id}`;
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.submit();
            });
        });
    </script>
</x-layout>
