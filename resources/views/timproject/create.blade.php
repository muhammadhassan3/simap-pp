<x-layout>
    @if(session('error'))
        <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(() => {
                let alertBox = document.getElementById("alert-error");
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s";
                    alertBox.style.opacity = "0";
                    setTimeout(() => alertBox.remove(), 500); // Hapus elemen setelah animasi
                }
            }, 3000); // Alert hilang setelah 3 detik
        </script>
    @endif
    <div class="container">
        <h2>Tambah Tim Proyek</h2>
        <form action="{{ route('tim-proyek.store') }}" method="POST">
            @csrf

            <!-- Dropdown Nama Proyek -->
            <div class="mb-3">
                <label class="form-label">Nama Proyek</label>
                <select name="id_project_disetujui" class="form-control">
                    <option value="" disabled {{ !isset($selected_project_id) ? 'selected' : '' }}>-- Pilih Nama Proyek --</option>
                    @foreach($proyek_disetujui as $proyek)
                        <option value="{{ $proyek->id }}" {{ isset($selected_project_id) && $selected_project_id == $proyek->id ? 'selected' : '' }}>
                            {{ $proyek->pengajuan_proposal->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Nama Pekerja -->
            <div class="mb-3">
                <label class="form-label">Nama Pekerja</label>
                <select name="id_pekerja" class="form-control">
                    <option value="" selected disabled>-- Pilih Nama Pekerja --</option>
                    @foreach($pekerja as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Peran -->
            <div class="mb-3">
                <label class="form-label">Peran</label>
                <select name="peran" class="form-control">
                    <option value="" selected disabled>-- Pilih Peran --</option>
                    <option value="pekerja">Pekerja</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="pengawas">Pengawas</option>
                </select>


                    <!-- Input Keahlian -->
                    <div class="mb-3">
                        <label class="form-label">Keahlian</label>
                        <input type="text" name="keahlian" class="form-control" placeholder="Masukkan Keahlian">
                    </div>


                    <!-- Tombol Simpan dan Batal -->
                    <div class="d-flex justify-content-end mt-3">
                        @if(isset($selected_project_id))
                            <a href="{{ route('tim-proyek.detail', $selected_project_id) }}" class="btn btn-secondary me-2">Batal</a>
                        @else
                            <a href="{{ route('tim-proyek.index') }}" class="btn btn-secondary me-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
