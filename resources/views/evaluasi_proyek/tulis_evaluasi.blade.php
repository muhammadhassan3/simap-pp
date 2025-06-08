<x-layout>
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('evaluasi.index') }}" class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>Kembali ke Evaluasi</a>
        </div>
        

        <h5 class="mt-3">Nama Proyek</h5>
        <input type="text" class="form-control" value="{{ $proyek->proyekDisetujui->pengajuanProposal->nama_proyek }}" readonly>

        <h5 class="mt-3">Durasi Proyek</h5>
        <input type="text" class="form-control" value="{{ $durasi }} hari" readonly>


        <h5 class="mt-3">Harga Proyek (Rp)</h5>
        <input type="text" class="form-control" value="{{ number_format($proyek->proyekDisetujui->pengajuanProposal->harga, 0, ',', '.') }}" readonly>

        <h5 class="mt-3">Tulis Evaluasi</h5>
        <form action="{{ route('evaluasi.update', $proyek->id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="keterangan" class="form-control mt-2" rows="4" placeholder="Tulis evaluasi di sini...">{{ $proyek->keterangan }}</textarea>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

</x-layout>
