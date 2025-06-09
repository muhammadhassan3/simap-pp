<x-layout>
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('kategori_proyek.index') }}" 
                class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Edit Kategori Proyek
            </a>
        </div>

        <form action="{{ route('kategori_proyek.update', $kategoriProyek->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{--            <div class="mb-3"> --}}
            {{--                <label for="id" class="form-label">ID Kategori</label> --}}
            {{--                <input type="text" name="id" class="form-control bg-light" value="{{ $kategoriProyek->id }}" --}}
            {{--                    required> --}}
            {{--            </div> --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control bg-light" value="{{ $kategoriProyek->nama }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control bg-light"
                    value="{{ $kategoriProyek->keterangan }}" required>
            </div>
            <div class="mb-3 pt-3">
                <button type="submit" class="btn btn-sm text-white w-100" style="background-color: #DEAA00;">Edit
                    Kategori Proyek</button>
            </div>
        </form>
    </div>
</x-layout>
