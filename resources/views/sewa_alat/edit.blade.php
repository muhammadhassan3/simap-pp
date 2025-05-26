<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Edit Sewa Alat Berat</div>
                <form action="{{ route('sewa_alat.update', $sewa_alat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-3">
                        <label for="nama_alat" class="form-label">Nama Alat</label>
                        <input type="text" class="form-control" name="nama_alat" value="{{ $sewa_alat->nama_alat }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_sewa" class="form-label">Harga Sewa</label>
                        <input type="number" class="form-control" name="harga_sewa" value="{{ $sewa_alat->harga_sewa }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Nama Perusahaan</label>
                        <select class="form-select" name="customer_id" required>
                            <option value="" disabled>Pilih Perusahaan</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $sewa_alat->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->nama_customer }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi (menit)</label>
                        <input type="number" class="form-control" name="durasi" value="{{ $sewa_alat->durasi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" class="form-control" name="qty" value="{{ $sewa_alat->qty }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_proyek" class="form-label">Nama Proyek</label>
                        <select class="form-select" name="id_proyek" required>
                            <option value="" disabled>Pilih Proyek</option>
                            @foreach($tempatProyek as $proyek)
                                <option value="{{ $proyek->id }}" {{ $sewa_alat->id_proyek == $proyek->id ? 'selected' : '' }}>
                                    {{ $proyek->nama_tempat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" name="detail" rows="3">{{ $sewa_alat->detail }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('sewa_alat.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

</x-layout>
