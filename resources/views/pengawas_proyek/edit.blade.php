<x-layout>
    <div class="container d-flex justify-content-center">
        <div class="card shadow w-50">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Pengawas Proyek</h2>

                <!-- Form Edit -->
                <form action="{{ route('pengawas-proyek.update', $pengawas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_proyek" class="form-label">Nama Proyek</label>
                        <input type="text" class="form-control" id="nama_proyek" name="nama_proyek"
                               value="{{ $pengawas->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada' }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="peran" class="form-label">Peran</label>
                        <input type="text" class="form-control" id="peran" name="peran"
                               value="{{ $pengawas['peran'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_pekerja" class="form-label">Nama Pekerja</label>
                        <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja"
                               value="{{ $pengawas->pekerja->nama ?? 'Tidak Ada' }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pengawas-proyek.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
