<x-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead {
            color: black;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white">
            <h2>Laporan Proyek</h2>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Proyek"
                    onkeyup="searchTable()">
            </div>

            <!-- Print Button -->
            <!-- <div class="mb-4 text-end">
                    <button class="btn btn-primary" onclick="printReport()">Cetak Laporan</button>
                </div> -->

            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th class="">Nama
                                Proyek
                            </th>
                            <th class="">Tempat
                                Proyek</th>
                            <th class="">Nama
                                Perusahaan</th>
                            <th class="">Tanggal
                                Mulai</th>
                            <th class="">Tanggal
                                Selesai</th>
                            <th class="">Aksi</th>

                        </tr>
                    </thead>
                    <tbody id="projectTable">
                        <!-- Loop through data -->
                        @foreach ($pembelian as $item)
                            <tr>
                                <td>
                                    {{ $item->proyek_disetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}
                                </td>
                                <td>
                                    {{ $item->proyek_disetujui->pengajuanProposal->tempatProyek->alamat ?? 'Tidak Ada Alamat' }}
                                </td>
                                <td>
                                    {{ $item->proyek_disetujui->pengajuanProposal->tempatProyek->nama_tempat ?? 'Tidak Ada Nama Proyek' }}

                                </td>
                                <td>
                                    {{ $item->proyek_disetujui->tanggal_mulai ?? 'Tidak Ada Tanggal Mulai' }}
                                </td>
                                <td>
                                    {{ $item->proyek_disetujui->tanggal_selesai ?? 'Tidak Ada Tanggal Selesai' }}
                                </td>
                                <td>
                                    <a href="{{ route('detail', ['id' => $item->proyek_disetujui->id]) }}"
                                        class="btn btn-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- JavaScript function to print the report -->
    <script>
        function printReport() {
            // Open a new window and print the content
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Laporan Proyek</title>');
            printWindow.document.write(
                '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">'
            );
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h4 class="text-center mb-4">Laporan Proyek</h4>');
            printWindow.document.write(document.querySelector('.table-responsive').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.getElementById('projectTable');
            tr = table.getElementsByTagName('tr');

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName('td')[0]; // Get the "Nama Proyek" column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</x-layout>
