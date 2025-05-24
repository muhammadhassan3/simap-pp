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
</x-layout>
