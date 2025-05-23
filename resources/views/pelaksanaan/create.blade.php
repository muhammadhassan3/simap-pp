<x-layout>

    <div class="w-full p-4 bg-white" style="border-radius: 20px;">
        <h5 class="text-dark fw-semibold mb-3">Tambah Pelaksanaan Proyek</h5>

        <div class="row g-2">
            <form action="{{ route('pelaksanaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_penjadwalan" value="{{ $penjadwalan->id }}">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror"
                        id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}"
                        required onclick="this.showPicker()">
                    @error('tanggal_pelaksanaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_pelaksanaan" class="form-label">Nama Pelaksanaan</label>
                    <input type="text" class="form-control @error('nama_pelaksanaan') is-invalid @enderror"
                        id="nama_pelaksanaan" name="nama_pelaksanaan" value="{{ old('nama_pelaksanaan') }}" required>
                    @error('nama_pelaksanaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        name="foto" accept="image/*" onchange="previewImage(event)">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Preview Gambar -->
                <div class="text-center mt-3">
                    <img id="preview" src="https://via.placeholder.com/150" class="img-thumbnail"
                        style="max-width: 150px; display: none;">
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                        rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('pelaksanaan.index', $penjadwalan->id) }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn text-white" style="background-color: #007ADE">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Preview Gambar --}}
    <script>
        function previewImage(event) {
            var preview = document.getElementById('preview');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        }
    </script>

    {{-- SweatAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

</x-layout>
