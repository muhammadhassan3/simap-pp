<div class="container mt-5">
    <div class="card mb-5 rounded">
        <div class="card-header">
            <h2 class="mb-3">Tambah Detail Pembelian</h2>
        </div>
        <div class="card-body">
            <div id="detailContainer">
                <!-- Contoh Baris Input -->
                @for ($i = 0; $i < $totalBarang; $i++)
                    <div class="detail-item d-flex align-items-center mb-2">
                        <div class="form-group me-2">
                            <input type="text" class="form-control" name="nama_produk[]" placeholder="Nama Produk"
                                required>
                        </div>
                        <div class="form-group me-2">
                            <select class="form-control" name="satuan[]" required>
                                <option value="" disabled selected>--Pilih Satuan--</option>
                                <option value="pcs">Pcs</option>
                                <option value="kg">Kg</option>
                                <option value="ton">Ton</option>
                                <option value="liter">Liter</option>
                                <option value="box">Box</option>
                            </select>
                        </div>
                        <div class="form-group me-2">
                            <input type="number" class="form-control qty" name="qty[]" placeholder="QTY" required>
                        </div>
                        <div class="form-group me-2">
                            <input type="text" class="form-control harga_satuan" name="harga_satuan[]"
                                placeholder="Harga Satuan" required oninput="formatCurrency(this)">
                        </div>
                        <div class="form-group me-2">
                            <input type="text" id="total_harga" class="form-control total_harga" name="total_harga[]"
                                placeholder="Total Harga" readonly>
                        </div>
                        <button class="btn btn-danger remove-detail" wire:click="kurang" type="button"
                            title="Hapus Detail Pembelian">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                @endfor
            </div>

            <!-- Tombol Tambah -->
            <div id="addDetail" wire:click="tambah" class="btn btn-primary btn-sm mt-3">
                + Tambah Detail Pembelian
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Event delegation: Dengarkan input pada parent
        document.addEventListener("input", function(event) {
            if (event.target.classList.contains("qty") || event.target.classList.contains(
                    "harga_satuan")) {

                const parentRow = event.target.closest(".detail-item");
                const qtyInput = parentRow.querySelector(".qty");
                const hargaInput = parentRow.querySelector(".harga_satuan");
                const totalInput = parentRow.querySelector(".total_harga");

                const qty = parseFloat(qtyInput.value) || 0;
                const hargaSatuan = parseFloat(hargaInput.value.replace('.','')) || 0;
                const totalHarga = qty * hargaSatuan;

                // Format angka dengan pemisah ribuan lokal Indonesia
                totalInput.value = totalHarga.toLocaleString("id-ID");
            }
        });
    });
</script>
