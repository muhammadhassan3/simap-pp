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

    <div class="card p-4">
        <a href="{{ route('pengajuan_proposal.index') }}" class="text-dark font-weight-bold mb-4">
            <i class="fas fa-arrow-left"></i> Tambah Proposal
        </a>
        <form action="{{ route('pengajuan_proposal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="form-group">
                <label for="nama_proyek" class="text-dark font-weight-bold">Nama Proyek</label>
                <input type="text" class="form-control bg-light" id="nama_proyek" name="nama_proyek"
                    placeholder="Masukkan nama proyek" required>
            </div>

            <div class="form-group">
                <label for="nama_tempat" class="text-dark font-weight-bold">Nama Tempat Proyek</label>
                <select id="nama_tempat" name="nama_tempat" class="form-control bg-light" required>
                    <option value="" selected>---PILIH TEMPAT---</option>
                    @foreach ($tempatProyek as $tp)
                        <option value="{{ $tp->id_tempat_proyek }}"
                            {{ old('nama_tempat') == $tp->id_tempat_proyek ? 'selected' : '' }}>
                            {{ $tp->nama_tempat }}
                        </option>
                    @endforeach
                </select>
                @error('nama_tempat')
                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_pengajuan" class="text-dark font-weight-bold">Tanggal Pengajuan</label>
                <input type="date" class="form-control bg-light" id="tanggal_pengajuan" name="tanggal_pengajuan" required>
            </div>

                <div class="form-group col-md-6">
                    <label for="harga_proyek" class="text-dark font-weight-bold">Harga Proyek</label>
                        <input type="text" class="form-control bg-light" id="harga_proyek" name="harga_proyek" required
                            placeholder="Masukkan harga proyek" oninput="formatCurrency(this)">
                </div>
                <div class="form-group col-md-6">
                    <label for="file_proposal" class="text-dark font-weight-bold">File Proposal</label>
                    <input type="file" class="form-control bg-light" id="file_proposal" name="file_proposal" required>
                </div>

            <div class="form-group">
                <label for="keterangan_proposal" class="text-dark font-weight-bold">Keterangan</label>
                <textarea class="form-control bg-light" id="keterangan_proposal" name="keterangan_proposal" placeholder="Tulis..."></textarea>
            </div>
</div>
            <button type="submit" class="btn btn-info w-100">Tambah Proposal</button>
        </form>
    </div>
    </div>
    </div>

<!-- Link ke JS Bootstrap (opsional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function setStatus(status) {
        document.getElementById('status').value = status;
        alert('Status diatur ke: ' + status);
    }
</script>
<script>
    function formatCurrency(input) {
        // Menghapus semua karakter yang bukan angka
        let value = input.value.replace(/[^0-9]/g, '');

        // Format angka dengan pemisah ribuan
        value = new Intl.NumberFormat('id-ID').format(value);

        // Mengupdate nilai input
        input.value = value;
    }
</script>
</body>


</x-layout>
