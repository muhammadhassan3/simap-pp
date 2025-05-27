<x-layout>
    <div class="container-box">
        <a href="{{ route('evaluasi.index') }}" class="btn-back">← Kembali ke Evaluasi</a>

        <h5 class="mt-3">Nama Proyek</h5>
        <input type="text" class="form-control" value="{{ $proyek->proyekDisetujui->pengajuanProposal->nama_proyek }}" readonly>

        <h5 class="mt-3">Durasi Proyek</h5>
        <input type="text" class="form-control" value="{{ $durasi }} hari" readonly>


        <h5 class="mt-3">Harga Proyek</h5>
        <input type="text" class="form-control" value="Rp {{ number_format($proyek->proyekDisetujui->pengajuanProposal->harga, 0, ',', '.') }}" readonly>

        <h5 class="mt-3">Tulis Evaluasi</h5>
        <form action="{{ route('evaluasi.update', $proyek->id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="keterangan" class="form-control mt-2" rows="4" placeholder="Tulis evaluasi di sini...">{{ $proyek->keterangan }}</textarea>

            <button type="submit" class="btn-save mt-3">Simpan</button>
        </form>
    </div>

</x-layout>
