<x-layout>
    @php
        $totalBelanja = 0;
        foreach ($detailPembelian as $item) {
            $totalBelanja += $item->qty * $item->harga_satuan;
        }
    @endphp
    <div class="container mt-4">
        <!-- Bagian Pembelian -->
        <a href="{{ route('pembelian.tampil') }}" class="text-dark">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
       <div class="card shadow mt-4">
            <style>
                .detail-row {
                    display: flex;
                    margin-bottom: 6px;
                }
                .detail-label {
                    width: 70px; /* Sesuaikan lebar label */
                    font-weight: bold;
                }
                .detail-colon {
                    width: 10px;
                    text-align: center;
                }
                .detail-value {
                    flex: 1;
                }
                .header-bg {
                    background-color: #e9ecef;
                    padding: 10px 15px;
                    margin-bottom: 15px;
                    width: 100%;
                }
            </style>
            <div class="header-bg">
                <h5 class="section-title m-0">Pembelian</h5>
            </div>
            <div class="card-body pt-0">

                <div class="detail-row">
                    <div class="detail-label">Tanggal</div>
                    <div class="detail-colon">:</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d-m-Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">No Nota</div>
                    <div class="detail-colon">:</div>
                    <div class="detail-value">{{ $pembelian->no_nota }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Proyek</div>
                    <div class="detail-colon">:</div>
                    <div class="detail-value">{{ $pembelian->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ditemukan' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nota</div>
                    <div class="detail-colon">:</div>
                    <div class="detail-value">
                        <a href="{{ asset('storage/' . $pembelian->foto_nota) }}" target="_blank">Lihat Nota</a>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Total</div>
                    <div class="detail-colon">:</div>
                    <div class="detail-value">Rp. {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Bagian Detail Pembelian -->
        <div class="card shadow mt-4">
            <div class="header-bg">
                <h5 class="section-title m-0">Detail Pembelian</h5>
            </div>
            <div class="card-body pt-0">
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
                            <div class="form-group me-2" style="width: 208px;">
                                <input type="text" class="form-control" value="{{ $detail->nama_produk }}" readonly>
                            </div>
                            <div class="form-group me-2" style="width: 207px;">
                                <input type="text" class="form-control" value="{{ $detail->satuan }}" readonly>
                            </div>
                            <div class="form-group me-2" style="width: 207px;">
                                <input type="text" class="form-control" value="{{ $detail->qty }}" readonly>
                            </div>
                            <div class="form-group me-2" style="width: 209px;">
                                <input type="text" class="form-control"
                                       value="{{ number_format($detail->harga_satuan, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group me-2" style="width: 207px;">
                                <input type="text" class="form-control" value="{{ $detail->total_harga }}" readonly>
                            </div>
                            <div class="form-group me-2" style="width: 150px;">
                                <a href="{{ route('pembelian.edit', $detail->id) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
