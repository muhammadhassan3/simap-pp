<x-layout>

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('dokumen.index') }}"
                    class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Tambah Dokumen Penyelesaian Proyek
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Row untuk Pilih Proyek & Upload Dokumen -->
                <div class="row">
                    <!-- Pilih Proyek -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_proyek_disetujui" class="form-label">Pilih Proyek</label>
                            <select name="id_proyek_disetujui" id="id_proyek_disetujui"
                                class="form-control select2 bg-black" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyekSelesai as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->pengajuanProposal->nama_proyek ??
                                            'Tidak Ada
                                                                                                                                                            Data' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Upload Dokumen -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">File Dokumen Penyelesaian Proyek</label>
                            <input type="file" name="file" class="form-control" accept="application/pdf" required>
                            <small class="text-muted">Format : <b>Pdf Only, max 5MB</b></small>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="4" minlength="10" maxlength="500"
                        placeholder="Tambahkan keterangan singkat..."></textarea>
                </div>

                <!-- Tombol Aksi -->
                <div>
                    <button type="submit" class="btn btn-primary btn-lg w-100"></i> Tambah Dokumen</button>
                    <a href="{{ route('dokumen.index') }}"></i></a>
                </div>
            </form>
        </div>
    </div>



    @push('scripts')
        <!-- Load jQuery & Select2 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#id_proyek_disetujui').select2({
                    placeholder: "-- Pilih Proyek --",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endpush
</x-layout>
