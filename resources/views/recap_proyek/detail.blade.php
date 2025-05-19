<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Laporan Proyek</title>
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
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h4 class="text-mb-4">Laporan Proyek</h4>

            <!-- Print Button -->
            <div class="mb-4 text-end">
                <a href="/convert/{{$id_proyek}}" class="btn btn-primary">Cetak Laporan</a>
            </div>

            <!-- Table for Pembelian -->
            <div class="table-responsive">
                <h5>Pembelian</h5>
                <table class="table table-striped align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Proyek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Proyek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang Dibeli</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody id="projectTable1">
                        <!-- Loop through pembelian data -->
                        @foreach($pembelian as $item)
                            <tr>
                                <td>{{ $item->pembelian->proyek_disetujui->pengajuan_proposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}</td>
                                <td>{{ $item->pembelian->proyek_disetujui->pengajuan_proposal->tempat_proyek->alamat ?? 'Tidak Ada Alamat' }}</td>
                                <td>{{ $item->pembelian->tanggal ?? 'Tanggal Tidak Tersedia' }}</td>
                                <td>{{ $item->nama_barang ?? 'Nama Barang Tidak Tersedia' }}</td>
                                <td class="total-pembelian">{{ $item->total_harga ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Total Pembelian row -->
                <div class="text-end mt-3">
                    <strong>Total Pembelian: </strong><span id="totalPembelian">0</span>
                </div>
            </div>

            <!-- Table for Penyewaan -->
            <div class="table-responsive mt-4">
                <h5>Penyewaan</h5>
                <table class="table table-striped align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Proyek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Proyek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang Disewa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody id="projectTable2">
                        <!-- Loop through penyewaan data -->
                        @foreach($penyewaan as $item)
                            <tr>
                                <td>{{ $item->proyek_disetujui->pengajuan_proposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}</td>
                                <td>{{ $item->proyek_disetujui->pengajuan_proposal->tempat_proyek->alamat ?? 'Tidak Ada Alamat' }}</td>
                                <td>{{ $item->nama_alat ?? 'Tidak Ada Alat' }}</td>
                                <td>{{ $item->total_harga_sewa ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- JavaScript function to calculate the total pembelian -->
    <script>
        // Function to calculate total pembelian
        function calculateTotalPembelian() {
            let totalPembelian = 0;
            const totalPembelianCells = document.querySelectorAll('.total-pembelian');
            totalPembelianCells.forEach(function(cell) {
                totalPembelian += parseFloat(cell.textContent) || 0;
            });
            document.getElementById('totalPembelian').textContent = totalPembelian.toFixed(2);
        }

        // Run the calculation when the page loads
        window.onload = function() {
            calculateTotalPembelian();
        };
    </script>
</body>
</html>
