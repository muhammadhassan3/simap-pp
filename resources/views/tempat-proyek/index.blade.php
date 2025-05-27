<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Tempat Proyek</div>
                <div class="d-flex justify-content-between align-items-start w-100 flex-wrap gap-3">
                    <!-- Tombol Aksi -->
                    <div class="d-flex flex-row gap-2">
                        <button class="btn"
                            style="background: #007ADE; color: white; font-size: 14px; border-radius: 8px;"
                            onclick="window.location.href='{{ route('add-tempat-proyek') }}'">
                            + Tambah Tempat Proyek
                        </button>
                        <button class="btn"
                            style="background: #007ADE; color: white; font-size: 14px; border-radius: 8px;"
                            onclick="window.location.href='{{ route('kategori_proyek.index') }}'">
                            Daftar Kategori Proyek
                        </button>
                    </div>

                    <!-- Form Pencarian -->
                    <div class="d-flex gap-2">
                        <div class="me-2">
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Cari Tempat Proyek">
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" onclick="onSearch()">Cari</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA --}}
            <div class="table-responsive p-2">
                <table class="table table-hover align-middle border rounded shadow-sm" style="table-layout: auto">
                    <thead class="table-secondary">
                        <tr class="w-100">
                            <th class="text-center">#</th>
                            <th class="">Tempat Proyek</th>
                            <th class="text-center align-items-start">Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $c = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    <div class="text-center">
                                        <div>
                                            <p>{{ $c++ }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-nowrap">{{ $item->nama_tempat }}
                                    </p>
                                </td>
                                <td class="align-middle text-start text-sm">
                                    <p class="text-xs font-weight-bold text-nowrap">{{ $item->alamat }}</p>
                                </td>
                                <td
                                    class="align-middle flex-row d-flex justify-content-center align-items-center gap-2">
                                    <div>
                                        <a href="{{ route('edit-tempat-proyek', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <div class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" onclick="selectItem({{ $item->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill m-auto" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus Tempat Proyek ini? Tempat Proyek yang dihapus tidak dapat
                    dikembalikan lagi.
                </div>
                <div class="modal-footer d-flex justify-content-end align-items-center gap-2 m-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 8px; margin-bottom: 20px;">
                        Close
                    </button>
                    <form method="POST" id="deleteForm" action="{{ route('delete-tempat-proyek') }}" class="m-0">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit" class="btn btn-danger" style="border-radius: 8px;">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function selectItem(id) {
            document.getElementById("id").value = id
        }

        function onSearch() {
            let query = document.getElementById("search").value
            if (query.length > 0) {
                window.location.href = "{{ route('show-tempat-proyek') }}?search=" + query
            }
        }
    </script>
</x-layout>
