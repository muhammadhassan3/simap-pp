<x-layout>
    <div class="mb-3">
        <h3 class="font-weight-bold text-md">Edit Monitoring Proyek</h3>
    </div>

<form action="{{ route('monitoring_proyek.update', $penjadwalan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $penjadwalan->keterangan ?? '') }}</textarea>
        @error('keterangan')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin menyimpan data ?')">Simpan</button>
    <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $monitoring_proyek->id_proyek_disetujui]) }}" class="btn btn-secondary">Kembali</a>
</form>

</x-layout>
