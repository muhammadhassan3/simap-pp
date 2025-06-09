<x-layout>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-dark fw-semibold mb-4">Tambah Pekerja</h5>

            <div class="row">
                <form action="{{ route('pekerja.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pekerja</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama') }}" style="border-radius: 10px; padding: 10px 15px;"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp') }}" style="border-radius: 10px; padding: 10px 15px;"
                            required>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('pekerja.index') }}" class="btn btn-secondary"
                            style="border-radius: 10px; padding: 10px 24px;">Batal</a>
                        <button type="submit" class="btn text-white"
                            style="background-color: #007ADE; border-radius: 10px; padding: 10px 24px;">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

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
