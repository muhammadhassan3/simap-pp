<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="">
                    <h4>Laporan Penjualan Produk</h4>
                </div>
                <br>
                <div class="row mb-2">
                    <div class="col-auto">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control form-control-sm" style="width: 200px; background-color:rgb(232, 232, 232); border: 1px solid #d9d9d9; color: #333; padding: 5px; border-radius: 5px;">
                    </div>
                    <div class="col-auto d-flex align-items-end">
                        <i class="bi bi-dash-lg"></i>
                    </div>
                    <div class="col-auto">
                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control form-control-sm" style="width: 200px; background-color:rgb(232, 232, 232); border: 1px solid #d9d9d9; color: #333; padding: 5px; border-radius: 5px;">
                    </div>
                    <div class="col-auto align-self-end">
                        <button id="filter-btn" type="submit" name="tampilkan" class="btn btn-primary btn-sm">Tampilkan</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a id="cetak-laporan" href="#" class="btn btn-success btn-sm mb-3">
                        <i class="bi bi-download me-1"></i> Cetak Laporan
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="dataTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TANGGAL</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CUSTOMER</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PRODUK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QTY</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HARGA</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL PEMBAYARAN</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JENIS PEMBAYARAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($detailpenjualan as $d)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $d["tanggal"] }}</td>
                                <td class="text-center">{{ $d["customer"] }}</td>
                                <td class="text-center">{{ $d["produk"] }}</td>
                                <td class="text-center">{{ $d["qty"] }}</td>
                                <td class="text-center">Rp {{ number_format($d["harga"], 0, ',', '.') }}</td>
                                <td class="text-center">Rp {{ number_format($d["total"], 0, ',', '.') }}</td>
                                <td class="text-center">{{ $d["jenis_pembayaran"] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th colspan="6" class="text-end">Total:</th>
                                <th id="totalKeseluruhan" class="text-center">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('button[name="tampilkan"]').addEventListener("click", function () {
                var startDate = document.getElementById("tgl_mulai").value;
                var endDate = document.getElementById("tgl_selesai").value;
                                
                if (startDate && endDate) {
                    console.log("Start Date:", startDate);
                    console.log("End Date:", endDate);

                    var rows = document.querySelectorAll("#dataTable tbody tr");
                    var totalFiltered = 0; // Untuk menyimpan total yang muncul

                    rows.forEach(function (row) {
                        var rowDate = row.cells[1].textContent.trim(); // Ambil tanggal dari kolom kedua (Tanggal)
                        var rowTotal = row.cells[6].textContent.replace(/[^\d]/g, ''); // Ambil total pembayaran dan hilangkan format Rp
                        
                        if (rowDate >= startDate && rowDate <= endDate) {
                            row.style.display = "";
                            totalFiltered += parseInt(rowTotal) || 0; // Tambahkan total pembayaran hanya jika baris terlihat
                        } else {
                            row.style.display = "none";
                        }
                    });

                    // Update total keseluruhan di footer tabel
                    document.querySelector("#totalKeseluruhan").textContent = "Rp " + totalFiltered.toLocaleString("id-ID");
                }
            });
        });

        document.getElementById("cetak-laporan").addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah reload halaman
            var startDate = document.getElementById("tgl_mulai").value;
            var endDate = document.getElementById("tgl_selesai").value;

            if (startDate && endDate) {
                var url = "/cetak?tgl_mulai=" + startDate + "&tgl_selesai=" + endDate;
                window.location.href = url; // Redirect untuk mengunduh file
            } else {
                alert("Pilih rentang tanggal terlebih dahulu!");
            }
        });
    </script>
</body>
</html>