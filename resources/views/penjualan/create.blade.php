<x-layout>
<div class="container">
    <h2>Tambah Penjualan</h2>

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="id_customer" class="form-control" required>
                <option value="">Pilih Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('id_customer') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->nama_customer }}
                    </option>
                @endforeach
            </select>
            @error('id_customer')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Penjualan</label>
            <input type="date" name="tanggal_penjualan" class="form-control" value="{{ old('tanggal_penjualan') }}">
            @error('tanggal_penjualan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>



        <!-- Jenis Pembayaran -->
        <div class="mb-3">
            <label class="form-label">Jenis Pembayaran</label>
            <select name="jenis_pembayaran" class="form-control" required>
                <option value="">Pilih Jenis</optiJon>
                <option value="Tunai" {{ old('jenis_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="LC" {{ old('jenis_pembayaran') == 'LC' ? 'selected' : '' }}>Letter of Credit (LC)
                </option>
            </select>
            @error('jenis_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Produk Table -->
        <div class="mb-3">
            <label class="form-label">Pilih Produk dan Masukkan Qty</label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Harga/kg</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($produkList as $produk)
                        <tr>
                            <td>
                                <input type="checkbox" name="id_produk[]" value="{{ $produk->id }}"
                                    {{ is_array(old('id_produk')) && in_array($produk->id, old('id_produk')) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $produk->nama }}</td>
                            <td>
                                <input type="number" name="qty[{{ $produk->id }}]" min="0"
                                    class="form-control" value="{{ old('qty.' . $produk->id) }}" placeholder="">
                            </td>

                            <td>
                                <select name="unit[{{ $produk->id }}]" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="kg" {{ old('unit.' . $produk->id) == 'kg' ? 'selected' : '' }}>
                                        kg</option>
                                    <option value="ton" {{ old('unit.' . $produk->id) == 'ton' ? 'selected' : '' }}>
                                        ton</option>
                                </select>
                            </td>
                            <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <small class="text-muted">Centang produk yang ingin dibeli, masukkan qty & pilih unit.</small>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</x-layout>
