<x-layout>

    <div class="container">
        <h2>Tambah Sewa Alat Berat</h2>
        <form action="{{ route('sewa_alat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_alat" class="form-label">Nama Alat</label>
                <input type="text" class="form-control" name="nama_alat" required>
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" name="harga_sewa" required>
            </div>
            <div class="mb-3">
                <label for="customer_id" class="form-label">Nama Vendor</label>
                <select class="form-select" name="customer_id" required>
                    <option value="" disabled selected>Pilih Perusahaan</option>
                    @foreach ($customers as $customer)
                        <!-- Mengganti $customer menjadi $customers -->
                        <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (menit)</label>
                <input type="number" class="form-control" name="durasi" required>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" class="form-control" name="qty" required>
            </div>
            <div class="mb-3">
                <label for="tempat_proyek_id" class="form-label">Nama Proyek</label>
                <select class="form-select" name="id_proyek" required>
                    <option value="" disabled selected>Pilih Proyek</option>
                    @foreach ($tempatProyek as $proyek)
                        <option value="{{ $proyek->id }}">{{ $proyek->pengajuanProposal->nama_proyek }} ({{ $proyek->pengajuanProposal->tempatProyek->nama_tempat }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" rows="3"></textarea>
            </div>
            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>
</x-layout>
