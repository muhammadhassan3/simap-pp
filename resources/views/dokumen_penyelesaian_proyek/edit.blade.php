<x-layout>

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex align-items-center gap-2 ">
                <a href="{{ route('dokumen.index') }}"
                    class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Edit Dokumen Penyelesaian Proyek
                </a>

            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Pilih Proyek -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_proyek_disetujui" class="form-label">Nama Proyek</label>
                            <select class="form-control" name="id_proyek_disetujui" required>
                                @foreach ($proyekSelesai as $proyek)
                                    <option value="{{ $proyek->id }}"
                                        {{ $proyek->id == $dokumen->id_proyek_disetujui ? 'selected' : '' }}>
                                        {{ $proyek->pengajuanProposal->nama_proyek ?? 'Tidak Ada Data' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">Dokumen (PDF)</label>
                            <input type="file" class="form-control" name="file">
                            @if ($dokumen->file)
                                <p class="mt-2">Dokumen saat ini:
                                    <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank"
                                        class="btn btn-info">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat Dokumen
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan">{{ $dokumen->keterangan }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning btn-lg w-100">Edit Dokumen</button>
                <a href="{{ route('dokumen.index') }}"></a>
            </form>
        </div>
    </div>

</x-layout>
