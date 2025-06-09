<x-layout>
    <div class="">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h2>Edit Penjualan</h2>

                <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_customer">Customer</label>
                        <select name="id_customer" class="form-control" required>
                            <option value="">Pilih Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ $penjualan->id_customer == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->nama_customer }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_penjualan">Tanggal Penjualan</label>
                        <input type="date" name="tanggal_penjualan" class="form-control"
                            value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}" required>

                    </div>

                    <div class="mb-3">
                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" class="form-control" required>
                            <option value="">Pilih Jenis Pembayaran</option>
                            <option value="Tunai" {{ $penjualan->jenis_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai
                            </option>
                            <option value="Down Payment"
                                {{ $penjualan->jenis_pembayaran == 'Down Payment' ? 'selected' : '' }}>Down Payment
                            </option>
                            <option value="Pelunasan"
                                {{ $penjualan->jenis_pembayaran == 'Pelunasan' ? 'selected' : '' }}>Pelunasan</option>
                        </select>
                    </div>


                    <hr>
                    <h4>Daftar Produk</h4>
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
                                @php
                                    $detailProduk = $penjualan->detailPenjualan->keyBy('id_produk');
                                @endphp

                                @foreach ($produk as $item)
                                    @php
                                        $isChecked = $detailProduk->has($item->id);
                                        $qty = $isChecked ? $detailProduk[$item->id]->qty : old('qty.' . $item->id, '');
                                        $unit = $isChecked
                                            ? $detailProduk[$item->id]->unit
                                            : old('unit.' . $item->id, '');
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id_produk[]" value="{{ $item->id }}"
                                                {{ $isChecked ? 'checked' : '' }}>
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <input type="number" name="qty[{{ $item->id }}]" min="0"
                                                class="form-control" value="{{ $qty }}">
                                        </td>
                                        <td>
                                            <select name="unit[{{ $item->id }}]" class="form-control">
                                                <option value="">Pilih Satuan</option>
                                                <option value="kg" {{ $unit == 'kg' ? 'selected' : '' }}>kg
                                                </option>
                                                <option value="ton" {{ $unit == 'ton' ? 'selected' : '' }}>ton
                                                </option>
                                            </select>
                                        </td>
                                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <small class="text-muted">Centang produk yang ingin dibeli, masukkan qty & pilih unit.</small>
                    </div>

                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
