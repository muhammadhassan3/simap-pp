<x-layout>
    <div class="container">
        <h2>Daftar Penjualan</h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('penjualan.index') }}" method="GET" class="mb-3 d-flex" role="search">
                    <input type="text" name="cari" class="form-control me-2"
                        placeholder="Cari customer / tanggal / pembayaran" value="{{ request('cari') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary ms-2">Reset</a>
                </form>

                <a href="{{ route('penjualan.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Tambah Penjualan
                </a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Tanggal</th>
                            <th>Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan as $item)
                            <tr @if (session('highlight_id') == $item->id) style="background-color: #d4edda;" @endif>
                                <td>{{ $item->customer->nama_customer }}</td>
                                <td>
                                    <ol class="mb-0 ps-3">
                                        @foreach ($item->detailPenjualan->take(3) as $detail)
                                            <li>{{ $detail->produk->nama_produk }}</li>
                                        @endforeach

                                        @if ($item->detailPenjualan->count() > 3)
                                            <li><em>dan {{ $item->detailPenjualan->count() - 3 }} lainnya...</em></li>
                                        @endif
                                    </ol>
                                </td>

                                <td>{{ date('d-m-Y', strtotime($item->tanggal_penjualan)) }}</td>
                                <td>{{ $item->jenis_pembayaran }}</td>
                                <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('penjualan.show', $item->id) }}"
                                            class="btn btn-info py-2 px-3">
                                            <i class="fas fa-eye "></i> Detail
                                        </a>

                                        <a href="{{ route('penjualan.edit', $item->id) }}"
                                            class="btn btn-warning  py-2 px-3">
                                            <i class="fas fa-edit "></i> Edit
                                        </a>

                                        <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST"
                                            class="form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger py-2 px-3  btn-hapus"> <i
                                                    class="fas fa-trash "></i> Hapus</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.querySelectorAll('.btn-hapus').forEach(function(button) {
                                button.addEventListener('click', function(e) {
                                    const form = this.closest('.form-hapus');

                                    Swal.fire({
                                        title: 'Yakin hapus?',
                                        text: 'Data tidak bisa dikembalikan setelah dihapus!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        cancelButtonColor: '#6c757d',
                                        confirmButtonText: 'Ya, hapus!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            form.submit();
                                        }
                                    });
                                });
                            });
                        </script>

                    </tbody>
                </table>

                {{ $penjualan->links('pagination::bootstrap-4') }}

            </div>
        </div>
    </div>
</x-layout>
