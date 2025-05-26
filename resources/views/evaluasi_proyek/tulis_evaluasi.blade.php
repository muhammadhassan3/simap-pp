<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <a href="{{ route('evaluasi.index') }}" class="text-dark me-2">← Kembali ke Evaluasi</a>

                <h5 class="mt-3">Nama Proyek</h5>
                <input type="text" class="form-control"
                    value="{{ $proyek->proyekDisetujui->pengajuanProposal->nama_proyek }}" readonly>

                <h5 class="mt-3">Tulis Evaluasi</h5>
                <form action="{{ route('evaluasi.update', $proyek->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="keterangan" class="form-control mt-2" rows="4" placeholder="Tulis evaluasi di sini...">{{ $proyek->keterangan }}</textarea>

                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
