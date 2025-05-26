<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Daftar Penjualan</div>

                {{-- Notifikasi sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                    <!-- Tombol Tambah Penjualan -->
                    <a href="{{ route('penjualan.create') }}" class="btn btn-success shadow-sm mt-3">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Penjualan
                    </a>

                    <!-- Form Pencarian -->
                    <form action="{{ route('penjualan.index') }}" method="GET"
                        class="d-flex align-items-center gap-2 w-40" role="search">
                        <input type="text" name="cari" class="form-control"
                            placeholder="Cari customer / tanggal / pembayaran" value="{{ request('cari') }}">
                        <button type="submit" class="btn btn-primary w-30 mt-3">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary w-30 mt-3">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    </form>


                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
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
                                                <li>{{ $detail->produk->nama }}</li>
                                            @endforeach
    
                                            @if ($item->detailPenjualan->count() > 3)
                                                <li><em>dan {{ $item->detailPenjualan->count() - 3 }}
                                                        lainnya...</em></li>
                                            @endif
                                        </ol>
                                    </td>
    
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_penjualan)) }}</td>
                                    <td>{{ $item->jenis_pembayaran }}</td>
                                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('penjualan.show', $item->id) }}"
                                                class="btn btn-primary py-2 px-3">
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
                                                <button type="button" class="btn btn-danger py-2 px-3  btn-hapus">
                                                    <i class="fas fa-trash "></i> Hapus</button>
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
    </div>

</x-layout>
