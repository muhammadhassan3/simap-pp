<x-layout>
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('kategori_proyek.index') }}" class="text-dark me-2">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h4 class="mb-0">Tambah Kategori Proyek</h4>
        </div>

        <form action="{{ route('kategori_proyek.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">ID Kategori</label>
                <input type="text" name="id" class="form-control bg-light" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control bg-light" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control bg-light" required>
            </div>
            <div class="mb-3 pt-3">
                <button type="submit" class="btn btn-sm text-white w-100" style="background-color: #007ADE;">Tambah
                    Kategori Proyek</button>
            </div>
        </form>
    </div>
</x-layout>
