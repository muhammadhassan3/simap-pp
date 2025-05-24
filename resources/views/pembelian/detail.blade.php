<!DOCTYPE html>
<html lang="id">
@php
    $totalBelanja = 0;
    foreach ($detailPembelian as $item) {
        $totalBelanja += $item->qty * $item->harga_satuan;
    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Bagian Pembelian -->
        <a href="{{ route('pembelian.tampil') }}" class="text-dark">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="card shadow mt-4">
            <div class="card-body">
                <h5 class="section-title">Pembelian</h5>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d-m-Y') }}</p>
                <p><strong>No Nota:</strong> {{ $pembelian->no_nota }}</p>
                <p><strong>Proyek:</strong>
                    {{ $pembelian->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ditemukan' }}</p>
                <p><strong>Nota:</strong> <a href="{{ asset('storage/' . $pembelian->foto_nota) }}"
                        target="_blank">Lihat
                        Nota</a></p>
                <p><strong>Total: Rp. {{ number_format($totalBelanja, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Bagian Detail Pembelian -->
        <div class="card shadow">
            <div class="card-body">
                <h5 class="section-title">Detail Pembelian</h5>
                <div id="detailContainer">

                    <div class="detail-item d-flex align-items-center mb-2">
                        <div class="form-group me-2" style="width: 208px;">
                            <div class="form-control bg-light fw-bold">Nama Produk</div>
                        </div>
                        <div class="form-group me-2" style="width: 207px;">
                            <div class="form-control bg-light fw-bold">Satuan</div>
                        </div>
                        <div class="form-group me-2" style="width: 207px;">
                            <div class="form-control bg-light fw-bold">QTY</div>
                        </div>
                        <div class="form-group me-2" style="width: 209px;">
                            <div class="form-control bg-light fw-bold">Harga Satuan</div>
                        </div>
                        <div class="form-group me-2" style="width: 207px;">
                            <div class="form-control bg-light fw-bold">Total Harga</div>
                        </div>
                        <div class="form-group me-2" style="width: 150px;">
                            <div class="form-control bg-light fw-bold">Aksi</div>
                        </div>
                    </div>

                    @foreach ($detailPembelian as $detail)
                        <div class="detail-item d-flex align-items-center mb-2">
                            <div class="form-group me-2">
                                <input type="text" class="form-control" value="{{ $detail->nama_produk }}" readonly>
                            </div>
                            <div class="form-group me-2">
                                <input type="text" class="form-control" value="{{ $detail->satuan }}" readonly>
                            </div>
                            <div class="form-group me-2">
                                <input type="text" class="form-control" value="{{ $detail->qty }}" readonly>
                            </div>
                            <div class="form-group me-2">
                                <input type="text" class="form-control"
                                    value="{{ number_format($detail->harga_satuan, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group me-2">
                                <input type="text" class="form-control" value="{{ $detail->total_harga }}" readonly>
                            </div>
                            <div class="form-group me-2">
                                <a href="{{ route('pembelian.edit', $detail->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
