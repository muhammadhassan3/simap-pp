<x-layout>
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        .btn-warning:hover {
            background-color: #d39e00 !important;
            border-color: #c69500 !important;
        }

        .btn-danger:hover {
            background-color: #b00020 !important;
            border-color: #98001b !important;
        }
    </style>
    <div class="container mt-4">
        <!-- Alert Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                role="alert" style="z-index: 1050;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow"
                role="alert" style="z-index: 1050;">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold mb-2">PRODUK</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="GET" action="{{ route('produk.index') }}" class="w-50">
                        <input type="text" id="searchProduk" name="search"
                            class="form-control form-control-sm bg-light border border-primary-subtle px-3 shadow-sm"
                            placeholder="Cari Produk..." value="{{ request('search') }}">
                    </form>
                    <a href="{{ route('produk.create') }}" class="btn btn-primary px-3">
                        <i class="bi bi-plus-lg"></i> Tambah Produk
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Harga/KG</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $index => $produk)
                                <tr>
                                    <td>{{ $index + $produks->firstItem() }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>Rp
                                        {{ is_numeric($produk->harga) ? number_format($produk->harga, 0, ',', '.') : 'Format salah' }}
                                    </td>
                                    <td>
                                        @if ($produk->foto)
                                            <img src="{{ Storage::url($produk->foto) }}" alt="Foto Produk"
                                                width="50" class="rounded">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ $produk->deskripsi ?? '-' }}</td>
                                    <td>{{ number_format($produk->satuan, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('produk.edit', $produk->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $produk->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $produk->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $produk->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteModalLabel{{ $produk->id }}">
                                                            Hapus <strong>{{ $produk->nama }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus
                                                            <strong>{{ $produk->nama }}</strong> dari Daftar Produk
                                                        </p>
                                                        <p class="text-danger"><strong>Produk yang dihapus tidak dapat
                                                                dikembalikan lagi.</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak, kembali</button>
                                                        <form action="{{ route('produk.destroy', $produk->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Ya,
                                                                hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada produk yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $produks->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
