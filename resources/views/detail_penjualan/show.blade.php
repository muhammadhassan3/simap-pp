<x-layout>
    <div class="container">
        <h2>Detail Penjualan</h2>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Customer: {{ $penjualan->customer->nama_customer }}</h5>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d-m-Y') }}
                </p>
                <p><strong>Jenis Pembayaran:</strong> {{ $penjualan->jenis_pembayaran }}</p>
                {{-- <p><strong>Total Harga:</strong> Rp{{ number_format($penjualan->total_harga, 0) }}</p> --}}
            </div>
        </div>

        <div class="card">
            <div class="card-header">Detail Produk</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan (per kg)</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp

                        @foreach ($penjualan->detailPenjualan as $detail)
                            @php
                                $qty = $detail->qty;
                                $unit = strtolower($detail->unit);
                                $hargaSatuan = $detail->harga_satuan;
                                $hargaPerKg = $unit === 'ton' ? $hargaSatuan / 1000 : $hargaSatuan;
                                $totalHarga = $qty * $hargaSatuan;
                                $grandTotal += $totalHarga;
                            @endphp
                            <tr>
                                <td>{{ $detail->produk->nama }}</td>
                                <td>{{ $qty }}</td>
                                <td>{{ $unit }}</td>
                                <td>Rp{{ number_format($hargaPerKg, 0) }}</td>
                                <td>Rp{{ number_format($totalHarga, 0) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-end"><strong>Total Keseluruhan</strong></td>
                            <td><strong>Rp{{ number_format($grandTotal, 0) }}</strong></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</x-layout>
