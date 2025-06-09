<x-layout>

    <!-- Konten Utama -->
    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white">
            <h2>Daftar Marketing</h2>

            <a href="{{ route('market.create') }}" class="btn btn-primary" style="margin-top: 10px; margin-bottom: 10px;">
                + Tambah Marketing
            </a>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="alert alert-success position-fixed top-0 end-0 m-3" id="alert">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => document.getElementById('alert').style.display = 'none', 3000);
                </script>
            @endif

            {{-- Fitur Search --}}
            <form action="{{ route('market.index') }}" method="GET">
                <div class="row mb-3 mt-3 d-flex align-items-end gap-2">

                    <!-- Input Nama Produk -->
                    <div class="col mb-3">
                        <input type="text" name="produk" class="form-control" list="productList"
                            placeholder="Cari Produk..." value="{{ request('produk') }}">
                        <datalist id="productList">
                            @foreach ($produks as $p)
                                <option value="{{ $p }}">
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Input Nama Customer -->
                    <div class="col mb-3">
                        <input type="text" name="customer" class="form-control" list="customerList"
                            placeholder="Cari Customer..." value="{{ request('customer') }}">
                        <datalist id="customerList">
                            @foreach ($customers as $c)
                                <option value="{{ $c->nama }}">
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Input Jenis Pembayaran -->
                    <div class="col mb-3">
                        <select name="jenis_pembayaran" class="form-control">
                            <option value="">Semua</option>
                            <option value="Tunai" {{ request('jenis_pembayaran') == 'Tunai' ? 'selected' : '' }}>
                                Tunai
                            </option>
                            <option value="DP" {{ request('jenis_pembayaran') == 'DP' ? 'selected' : '' }}>
                                DP</option>
                        </select>
                    </div>

                    <!-- Input Tanggal Pembelian -->
                    <div class="col mb-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}"
                            onclick="this.showPicker()">
                    </div>

                    <!-- Tombol Cari & Clear -->
                    <div class="col d-flex gap-2">
                        <button type="submit" class="btn btn-primary">🔍 Cari</button>
                        <a href="{{ route('market.index') }}" class="btn btn-secondary">❌ Clear</a>
                    </div>
                </div>
            </form>


            <!-- Tabel Marketing -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Nama Produk</th>
                            <th>Tanggal Pembelian</th>
                            <th>Tujuan Pembelian</th>
                            <th>Jenis Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($marketings as $key => $marketing)
                            <tr>
                                <td class="text-center">
                                    {{ ($marketings->currentPage() - 1) * $marketings->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $marketing->customer->nama_customer ?? '-' }}</td>
                                <td>{{ $marketing->produk->nama }}</td>
                                <td>{{ $marketing->tanggal_pembelian }}</td>
                                <td class="text-truncate" style="max-width: 200px;">
                                    {{ $marketing->tujuan_pembelian }}</td>
                                <td>{{ $marketing->jenis_pembayaran }} @if ($marketing->keterangan_pembayaran)
                                        ({{ $marketing->keterangan_pembayaran }})
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol untuk membuka modal -->
                                    <button class="btn align-middle"
                                        style="background-color: #3b82f6; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;"
                                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $marketing->id }}">
                                        <img style="width: 18px; height: 18px; vertical-align: middle;"
                                            src="https://img.icons8.com/?size=100&id=132&format=png&color=FFFFFF"
                                            alt="Detail">
                                    </button>
                                    {{-- tombol edit --}}
                                    <a href="{{ route('market.edit', $marketing->id) }}" class="btn align-middle"
                                        style="background-color: #efb944; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                        <img style="width: 18px; height: 18px; vertical-align: middle;"
                                            src="https://img.icons8.com/?size=100&id=86374&format=png&color=FFFFFF"
                                            alt="Edit">
                                    </a>
                                    {{-- tombol delete --}}
                                    <form id="deleteForm-{{ $marketing->id }}"
                                        action="{{ route('market.delete', $marketing->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-edit align-middle"
                                            onclick="confirmDelete('{{ $marketing->id }}', '{{ $marketing->customer->nama }}')"
                                            style="background-color: #ef4444; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                            <img style="width: 18px; height: 18px; vertical-align: middle;"
                                                src="https://img.icons8.com/?size=100&id=DU8dSXkvLUkx&format=png&color=FFFFFF"
                                                alt="Hapus">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="d-flex justify-content-center">
                {{ $marketings->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    {{-- modal untuk menampilkan fungsi detail / show --}}
    @foreach ($marketings as $marketing)
        <!-- Modal lihat detail marketing -->
        <div class="modal fade" id="detailModal{{ $marketing->id }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $marketing->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Gunakan modal-lg agar lebih besar -->
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalLabel{{ $marketing->id }}">Detail Marketing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Informasi Customer -->
                        <div class="card mb-3">
                            <div class="card-header bg-secondary text-white">Informasi Customer</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $marketing->customer->nama_customer ?? '-' }}</h5>
                                <p class="card-text"><strong>Email:</strong> {{ $marketing->customer->email ?? '-' }}
                                </p>
                                <p class="card-text"><strong>Telepon:</strong>
                                    {{ $marketing->customer->no_hp ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Informasi Produk -->
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">Informasi Produk</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $marketing->produk->nama }}</h5>
                                <p class="card-text"><strong>Deskripsi:</strong> {{ $marketing->produk->deskripsi }}
                                </p>
                                <p class="card-text"><strong>Harga:</strong>
                                    Rp{{ number_format($marketing->produk->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Detail Transaksi -->
                        <div class="card">
                            <div class="card-header bg-warning text-dark">Detail Transaksi</div>
                            <div class="card-body">
                                <p><strong>Tujuan Pembelian:</strong> {{ $marketing->tujuan_pembelian }}</p>
                                <p><strong>Jenis Pembayaran:</strong> {{ $marketing->jenis_pembayaran }}</p>
                                <p><strong>Keterangan Pembayaran:</strong>
                                    {{ $marketing->keterangan_pembayaran ?? '-' }}</p>
                                <p><strong>Tanggal Pembelian:</strong>
                                    {{ $marketing->tanggal_pembelian }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successToast = document.getElementById('successToast');
            if (successToast && successToast.querySelector('.toast-body').textContent.trim() !== '') {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }
        });
        //alert konfirmasi delete
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Data "${name}" akan dihapus dan tidak bisa dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form dengan ID yang sesuai
                    document.getElementById(`deleteForm-${id}`).submit();
                }
            });
        }
    </script>
</x-layout>
