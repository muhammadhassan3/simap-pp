<x-layout>
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-3">Tambah Pengawas Proyek</h2>

            <form action="{{ route('pengawas-proyek.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id_project_disetujui" class="form-label">Nama Proyek</label>
                    <select class="form-select" name="id_project_disetujui" id="id_project_disetujui" required>
                        <option value="">-- Pilih Proyek --</option>
                        @foreach ($proyekDisetujui as $proyek)
                            <option value="{{ $proyek->id }}">{{ $proyek->pengajuanProposal->nama_proyek }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_pekerja" class="form-label">Nama Pekerja</label>
                    <select class="form-select" name="id_pekerja" id="id_pekerja" required>
                        <option value="">-- Pilih Pekerja --</option>
                        @foreach ($pekerja as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keahlian" class="form-label">Keahlian</label>
                    <input type="text" class="form-control" name="keahlian" id="keahlian" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pengawas-proyek.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
