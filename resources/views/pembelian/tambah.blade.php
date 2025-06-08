<x-layout>
    @livewireScripts
    @livewireStyles
    <div class="container mt-5">
        <div class="card shadow mb-5">
            <div class="card-header d-flex align-items-center">
                <a href="/pembelian" class="text-dark mr-3"><i class="fas fa-arrow-left"></i></a>
                <h4 class="mb-0">Tambah Data Pembelian</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pembelian.simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="tanggal">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="no_nota">No Nota</label>
                        <input type="text" class="form-control" id="no_nota" name="no_nota" required
                               placeholder="Masukkan No Nota">
                        <input type="text" class="form-control" id="no_nota" name="satuan_list" hidden>

                        <div class="form-group">
                            <label for="foto_nota">Upload Nota</label>
                            <input type="file" class="form-control" id="foto_nota" name="foto_nota" required>
                        </div>

                        <div class="form-group">
                            <label for="id_proyek_disetujui">Nama Proyek</label>
                            <select class="form-control" name="id_proyek_disetujui" id="id_proyek_disetujui" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyekDisetujui as $proyek)
                                    <option value="{{ $proyek->id }}">
                                        {{ $proyek->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @livewire(DetailPembelian::class)

                        <button type="submit" class="btn btn-primary">Tambah Pembelian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function formatCurrency(input) {
            // Menghapus semua karakter yang bukan angka
            let value = input.value.replace(/[^0-9]/g, '');

            // Format angka dengan pemisah ribuan
            value = new Intl.NumberFormat('id-ID').format(value);

            // Mengupdate nilai input
            input.value = value;
        }
    </script>
</x-layout>
