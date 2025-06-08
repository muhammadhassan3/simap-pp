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
    <div class="">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h4 class="text-mb-4">Laporan Proyek</h4>

                <!-- Print Button -->
                <div class="mb-4 text-end">
                    <a href="{{ route('convert', $id_proyek) }}" class="btn btn-primary">Cetak Laporan</a>
                </div>

                <!-- Table for Pembelian -->
                <div class="table-responsive">
                    <h5>Pembelian</h5>
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    Proyek
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                                    Proyek</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang
                                    Dibeli</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total
                                    Pembelian</th>
                            </tr>
                        </thead>
                        <tbody id="projectTable1">
                            <!-- Loop through pembelian data -->
                            @foreach ($detailPembelian as $item)
                                <tr class="border-b">
                                    <td>{{ $item->pembelian->proyek_disetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}
                                    </td>
                                    <td>{{ $item->pembelian->proyek_disetujui->pengajuanProposal->tempatProyek->alamat ?? 'Tidak Ada Alamat' }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->pembelian->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td class="text-right">
                                        {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Total Pembelian row -->
                    <div class="text-end mt-3">
                        <strong>Total Pembelian: </strong><span>{{ number_format($totalPembelian, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Table for Penyewaan -->
                <div class="table-responsive mt-4">
                    <h5>Penyewaan</h5>
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    Proyek
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                                    Proyek</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang
                                    Disewa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total
                                    Pembelian</th>
                            </tr>
                        </thead>
                        <tbody id="projectTable2">
                            <!-- Loop through penyewaan data -->
                            @foreach ($penyewaan as $item)
                                <tr>
                                    <td>
                                        {{ $item->tempatProyek->nama_tempat ?? 'Tidak Ada Nama Proyek' }}
                                    </td>
                                    <td>{{ $item->tempatProyek->alamat ?? 'Tidak Ada Alamat' }}
                                    </td>
                                    <td>{{ $item->nama_alat ?? 'Tidak Ada Alat' }}</td>
                                    <td>{{ $item->harga_sewa ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- JavaScript function to calculate the total pembelian -->
    <script>
        function calculateTotalPembelian() {
            let totalPembelian = 0;
            const totalPembelianCells = document.querySelectorAll('.total-pembelian');
            totalPembelianCells.forEach(function(cell) {
                // Parse nilai text ke float dan tambahkan
                totalPembelian += parseFloat(cell.textContent) || 0;
            });
            // Tampilkan hasil total dengan 2 angka di belakang koma
            document.getElementById('totalPembelian').textContent = totalPembelian.toFixed(2);
        }

        window.onload = function() {
            calculateTotalPembelian();
        };
    </script>
</x-layout>
