<x-layout>
    <div class="container d-flex justify-content-center">
        <div class="card shadow w-100">
            <div class="card-body">
                <br>

                <div class="d-flex flex-row w-25 mb-1 items-center justify-content-between">
                    <div class="me-2">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Cari Tempat Proyek">
                    </div>
                    <div >
                        <button type="button" class="btn btn-primary" onclick="onSearch()">Cari</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA PROYEK</th>
                            <th class="text-center">PERAN</th>
                            <th class="text-center">NAMA PEKERJA</th>
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
                            <td class="text-center">
                                <a href="{{ route('pengawas-proyek.edit', $item['id']) }}" class="btn" style="background-color: #DEAA00;">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        // Fitur Pencarian
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });
    </script>

    <script>
        function selectItem(id) {
            document.getElementById("id").value = id
        }

        function onSearch(i) {
            let query = document.getElementById("search").value
            if (query.length > 0) {
                window.location.href = "{{route('pengawas-proyek.index')}}?search=" + query
            } else {
            }
        }
    </script>

</x-layout>
