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
                        @foreach($data as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item['nama_proyek'] }}</td>
                            <td class="text-center">{{ $item['peran'] }}</td>
                            <td class="text-center">{{ $item['nama_pekerja'] }}</td>
                            <td class="text-center">{{ $item['keahlian'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('pengawas-proyek.edit', $item['id']) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="showDeleteModal(this)" data-url="{{ route('pengawas-proyek.delete', $item['id']) }}">
                                    <i class="bi bi-trash-fill text-white"></i>
                                </button>
                                @include('pengawas_proyek.delete')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
