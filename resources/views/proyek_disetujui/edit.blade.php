<x-layout>
    <div class="container mt-4">
        <div class="card p-4">
            <a href="{{ route('proyekdisetujui.index') }}" class="text-dark d-flex align-items-center">
                <h4><i class="bi bi-arrow-left me-2"></i> <span>Edit Status</span></h4>
            </a>


            <form action="{{ route('proyekdisetujui.update', $proyek->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Proyek</label>
                    <input type="text" class="form-control" value="{{ $proyek->pengajuan_proposal->nama_proyek }}"
                           disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Proyek</label>
                    <input type="text" class="form-control"
                           value="{{ $proyek->pengajuan_proposal->tempat_proyek->nama }}"
                           disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Proyek</label>
                    <input type="text" class="form-control" value="{{ $proyek->pengajuan_proposal->harga }}"
                           disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Tersedia" {{ $proyek->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dikerjakan" {{ $proyek->status == 'Dikerjakan' ? 'selected' : '' }}>Dikerjakan
                        </option>
                        <option value="Batal" {{ $proyek->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                        <option value="Selesai" {{ $proyek->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $proyek->tanggal_mulai }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ $proyek->tanggal_selesai }}"
                    >
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn text-white" style="background-color: #DEAA00;">Edit Status</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
