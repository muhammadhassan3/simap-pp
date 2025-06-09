<x-layout>
    @livewireScripts
    @livewireStyles
    <div class="container mt-5">
        <div class="card shadow mb-5">
            <div class="card-header d-flex align-items-center">
                <a href="{{ route('pembelian.detail', $detail->id_pembelian) }}" class="text-dark mr-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h4 class="mb-0">Edit Detail Pembelian</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pembelian.update', $detail->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                               value="{{ $detail->nama_produk }}" required>
                    </div>

                    <div class="form-group">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" name="satuan" required>
                            <option value="" disabled {{ $detail->satuan == '' ? 'selected' : '' }}>--Pilih
                                Satuan--
                            </option>
                            <option value="pcs" {{ $detail->satuan == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="kg" {{ $detail->satuan == 'kg' ? 'selected' : '' }}>Kg</option>
                            <option value="ton" {{ $detail->satuan == 'ton' ? 'selected' : '' }}>Ton</option>
                            <option value="liter" {{ $detail->satuan == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="box" {{ $detail->satuan == 'box' ? 'selected' : '' }}>Box</option>
                        </select>
                    </div>
                    <div class="form-group me-2">
                        <label for="qty" class="form-label">QTY</label>
                        <input type="number" class="form-control qty" id="qty" name="qty"
                               value="{{ $detail->qty }}" min="0" required>
                    </div>
                    <div class="form-group me-2">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="text" class="form-control harga_satuan" id="harga_satuan" name="harga_satuan"
                               value="{{ number_format($detail->harga_satuan, 0, ',', '.') }}" required oninput="formatCurrency(this)">
                    </div>
                    <div class="form-group me-2">
                        <label for="total_harga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                               value="{{ number_format($detail->total_harga, 0, ',', '.') }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function formatCurrency(input) {
            // Menghapus semua karakter yang bukan angka
            let value = input.value.replace(/[^0-9]/g, '');

            // Format angka dengan pemisah ribuan
            value = new Intl.NumberFormat('id-ID').format(value);

            // Mengupdate nilai input
            input.value = value;
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Event delegation: Dengarkan input pada parent
            document.addEventListener("input", function(event) {
                if (event.target.classList.contains("qty") || event.target.classList.contains(
                    "harga_satuan")) {
                    const qtyInput = document.getElementById("qty");
                    const hargaInput = document.getElementById("harga_satuan");
                    const totalInput = document.getElementById("total_harga");

                    const qty = parseInt(qtyInput.value) || 0;
                    const hargaSatuan = parseInt(hargaInput.value.replace(/\./g,'')) || 0;
                    console.log(`${qty} * ${hargaSatuan} (${hargaInput.value} = ${hargaInput.value.replace(/\./g,'')})`)
                    const totalHarga = qty * hargaSatuan;

                    // Format angka dengan pemisah ribuan lokal Indonesia
                    totalInput.value = totalHarga.toLocaleString("id-ID");
                }
            });
        });
    </script>
</x-layout>
