<x-layout>
    <div class="content container mt-4">
        <h2 class="mb-4">Tambah Marketing</h2>

        <form action="{{ route('market.store') }}" method="POST">
            @csrf

            <!-- Nama Produk & Nama Customer -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer" class="form-label">Nama Customer</label>
                    <select class="form-select" name="customer_id">
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customer as $c)
                            <option value="{{ $c['id'] }}">{{ $c['nama_customer'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="produk" class="form-label">Nama Produk</label>
                    <select class="form-select" name="produk_id">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produk as $p)
                            <option value="{{ $p['id'] }}">{{ $p['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tujuan Pembelian -->
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan Pembelian</label>
                <textarea class="form-control" name="tujuan_pembelian" id="tujuan"></textarea>
            </div>

            <!-- Jenis Pembayaran & Keterangan Pembayaran -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                    <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran">
                        <option value="">-- Pilih Jenis Pembayaran --</option>
                        <option value="Tunai">Tunai</option>
                        <option value="DP">DP</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                    <input type="text" class="form-control" name="keterangan_pembayaran" id="keterangan">
                </div>
            </div>

            <!-- Tanggal Pembelian -->
            <div class="mb-3">
                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian"
                       onclick="this.showPicker()">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</x-layout>
