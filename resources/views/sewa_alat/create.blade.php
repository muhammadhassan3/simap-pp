<x-layout>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Tambah Sewa Alat Berat</div>
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
                        <label for="tempat_proyek_id" class="form-label">Nama Tempat Proyek</label>
                        <input type="text" class="form-control" value="{{ $proyekDisetujui->pengajuanProposal->tempatProyek->nama_tempat }}" readonly>
                        <input type="hidden" name="id_proyek" value="{{ $id_proyek_disetujui }}">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" name="detail" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('sewa_alat.index', ['id_proyek_disetujui' => $id_proyek_disetujui]) }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
