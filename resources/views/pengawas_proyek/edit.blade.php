<x-layout>
    <div class="card shadow ">
        <div class="card-body">
            <h2 class="mb-4">Edit Pengawas Proyek</h2>

            <form action="{{ route('pengawas-proyek.update', $pengawas->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="id_project_disetujui" class="form-label">Nama Proyek</label>
                    <select class="form-select" id="id_project_disetujui" name="id_project_disetujui" required>
                        <option value="">-- Pilih Proyek --</option>
                        @foreach ($proyekDisetujui as $proyek)
                            <option value="{{ $proyek->id }}"
                                {{ $pengawas->id_project_disetujui == $proyek->id ? 'selected' : '' }}>
                                {{ $proyek->pengajuanProposal->nama_proyek ?? 'Tanpa Nama' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="peran" class="form-label">Peran</label>
                    <input type="text" class="form-control" id="peran" name="peran"
                        value="{{ $pengawas->peran }}" required>
                </div>
                <div class="mb-3">
                    <label for="id_pekerja" class="form-label">Nama Pekerja</label>
                    <select class="form-select" id="id_pekerja" name="id_pekerja" required>
                        <option value="">-- Pilih Pekerja --</option>
                        @foreach ($pekerja as $p)
                            <option value="{{ $p->id }}" {{ $pengawas->id_pekerja == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keahlian" class="form-label">Keahlihan</label>
                    <input type="text" class="form-control" id="keahlian" name="keahlian"
                        value="{{ $pengawas->keahlian }}" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pengawas-proyek.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
