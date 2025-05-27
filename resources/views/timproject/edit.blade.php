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
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Edit Tim Proyek</div>
                <form action="{{ route('tim-proyek.update', $tim->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dropdown Nama Proyek -->
                    <div class="mb-3">
                        <label class="form-label">Nama Proyek</label>
                        <select name="id_project_disetujui" class="form-control">
                            @foreach($proyek_disetujui as $proyek)
                                <option value="{{ $proyek->id }}"
                                    {{ $proyek->id == old('id_project_disetujui', $tim->id_project_disetujui) ? 'selected' : '' }}>
                                    {{ $proyek->pengajuan_proposal->nama_proyek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Nama Pekerja -->
                    <div class="mb-3">
                        <label class="form-label">Nama Pekerja</label>
                        <select name="id_pekerja" class="form-control">
                            @foreach($pekerja as $p)
                                <option value="{{ $p->id }}"
                                    {{ $p->id == old('id_pekerja', $tim->id_pekerja) ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown untuk Peran -->
                    <div class="mb-3">
                        <label class="form-label">Peran</label>
                        <select name="peran" class="form-control">
                            <option value="pekerja" {{ $tim->peran == 'pekerja' ? 'selected' : '' }}>Pekerja</option>
                            <option value="supervisor" {{ $tim->peran == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="pengawas" {{ $tim->peran == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                        </select>
                    </div>

                    <!-- Input untuk Keahlian -->
                    <div class="mb-3">
                        <label class="form-label">Keahlian</label>
                        <input type="text" name="keahlian" class="form-control" value="{{ old('keahlian', $tim->keahlian ?? '') }}">
                    </div>

                    <!-- Tombol Simpan & Batal -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('tim-proyek.detail', $tim->id_project_disetujui) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
