<x-layout>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
        <a href="{{ route('pengajuan_proposal.index') }}" class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i> Ubah Proposal
        </a>

        <form action="{{ route('pengajuan_proposal.update', $proposal->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Nama Proyek -->
            <div class="form-group">
                <label for="nama_proyek" class="text-dark font-weight-bold">Nama Proyek</label>
                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek"
                    value="{{ old('nama_proyek', $proposal->nama_proyek) }}" required>
            </div>

            <!-- Nama Tempat Proyek (select) -->
            <div class="form-group">
                <label for="id_tempat_proyek" class="text-dark font-weight-bold">Nama Tempat Proyek</label>
                <select id="id_tempat_proyek" name="id_tempat_proyek" class="form-control" required>
                    <option value="" disabled>---PILIH---</option>
                    @foreach ($tempatProyek as $tp)
                        <option value="{{ $tp->id }}"
                            {{ old('id_tempat_proyek', $proposal->id_tempat_proyek) == $tp->id ? 'selected' : '' }}>
                            {{ $tp->nama_tempat }}
                        </option>
                    @endforeach
                </select>
                @error('id_tempat_proyek')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Pengajuan -->
            <div class="form-group">
                <label for="tanggal_pengajuan" class="text-dark font-weight-bold">Tanggal Pengajuan</label>
                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan"
                    value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan) }}" required>
            </div>

            <!-- Harga Proyek -->
            <div class="form-group">
                <label for="harga_proyek" class="text-dark font-weight-bold">Harga Proyek</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="harga_proyek" name="harga_proyek" required
                        placeholder="Masukkan harga proyek"
                        value="{{ old('harga_proyek', number_format($proposal->harga, 0, ',', '.')) }}"
                        oninput="formatCurrency(this)">
                </div>
            </div>

            <!-- File Proposal -->
            <div class="form-group">
                <label for="file_proposal" class="text-dark font-weight-bold">File Proposal</label>
                <input type="file" class="form-control" id="file_proposal" name="file_proposal">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
                @if ($proposal->file_proposal)
                    <p class="mt-2">
                        File saat ini: <a href="{{ asset('proposal/' . $proposal->file_proposal) }}"
                            target="_blank">Lihat File</a>
                    </p>
                @endif
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan_proposal" class="text-dark font-weight-bold">Keterangan</label>
                <textarea class="form-control" id="keterangan_proposal" name="keterangan_proposal" required>{{ old('keterangan_proposal', $proposal->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning w-100">Ubah Proposal</button>
        </form>
    </div>


    <!-- Link ke JS Bootstrap (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ""); // Hapus karakter selain angka
            value = new Intl.NumberFormat('id-ID').format(value); // Format angka
            input.value = value;
        }
    </script>





</x-layout>
