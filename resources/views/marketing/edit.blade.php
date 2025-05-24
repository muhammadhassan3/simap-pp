<x-layout>
    <!-- Konten Utama -->
    <div class="content container mt-4">
        <h2 class="mb-4">Edit Marketing</h2>

        <form action="{{ route('market.update', $marketing->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Produk & Nama Customer -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer" class="form-label">Nama Customer</label>
                    <select class="form-select" name="customer_id">
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customer as $c)
                            <option value="{{ $c->id }}"
                                {{ $c->id == $marketing->customer_id ? 'selected' : '' }}>
                                {{ $c->nama_customer }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="produk" class="form-label">Nama Produk</label>
                    <select class="form-select" name="produk_id">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produk as $p)
                            <option value="{{ $p->id }}"
                                {{ $p->id == $marketing->produk_id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tujuan Pembelian -->
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan Pembelian</label>
                <textarea class="form-control" name="tujuan_pembelian"
                          id="tujuan">{{ $marketing->tujuan_pembelian }}</textarea>
            </div>

            <!-- Jenis Pembayaran & Keterangan Pembayaran -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                    <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran">
                        <option value="Tunai" {{ $marketing->jenis_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai
                        </option>
                        <option value="DP" {{ $marketing->jenis_pembayaran == 'DP' ? 'selected' : '' }}>DP
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                    <input type="text" class="form-control" name="keterangan_pembayaran" id="keterangan"
                           value="{{ $marketing->keterangan_pembayaran }}">
                </div>
            </div>

            <!-- Tanggal Pembelian -->
            <div class="mb-3">
                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian"
                       value="{{ $marketing->tanggal_pembelian }}" onclick="this.showPicker()">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('market.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var successToast = document.getElementById('successToast');
            if (successToast && successToast.querySelector('.toast-body').textContent.trim() !== '') {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }
        });
    </script>

</x-layout>
