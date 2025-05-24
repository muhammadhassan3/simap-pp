<x-layout>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-center">
                <div class="w-75">
                    <a href="{{ route('produk.index') }}" class="btn btn-light mb-3 fw-bold">
                        ← Daftar Produk
                    </a>

                    <form action="{{ isset($produk) ? route('produk.update', $produk->id) : route('produk.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($produk)
                            @method('PUT')
                        @endisset

                        @isset($produk)
                            <div class="mb-3">
                                <label class="form-label">ID Produk</label>
                                <input type="text" class="form-control" value="{{ $produk->id }}" readonly>
                            </div>
                        @endisset

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ old('nama', $produk->nama ?? '') }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control"
                                    value="{{ old('harga', $produk->harga ?? '') }}" required min="1">
                                @error('harga')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Qty</label>
                                <input type="number" name="satuan" class="form-control"
                                    value="{{ old('satuan', $produk->satuan ?? '') }}" required min="1">
                                @error('satuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Produk</label>
                            <input type="file" name="foto" class="form-control">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if (isset($produk) && $produk->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" width="100"
                                        alt="Foto Produk">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ route('produk.index') }}" class="btn btn-danger text-white px-4 py-2 border-0">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success text-white px-4 py-2 border-0">
                                {{ isset($produk) ? 'Simpan Perubahan' : 'Tambah Produk' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
