<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h2 class="mb-3">Tabel Pembelian</h2>

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                    <a href="{{ route('pembelian.tambah') }}" class="btn btn-success shadow-sm mt-3">+ Tambah
                        Pembelian</a>

                    <!-- Form Pencarian -->
                    <form class="d-flex align-items-center gap-2 w-40" style="flex-grow: 1; max-width: 500px;">

                        <input type="search" id="searchProject" class="form-control"
                            placeholder="Cari berdasarkan Tanggal atau Nama Proyek" aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>

                    </form>

                </div>
            </div>

            <div class="table-responsive p-2">
                <table class="table table-hover align-middle border rounded shadow-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-center">No</th>
                            <th scope="col" class="px-4 py-2 text-center">Tanggal</th>
                            <th scope="col" class="px-4 py-2 text-center">No Nota</th>
                            <th scope="col" class="px-4 py-2 text-center">Nota</th>
                            <th scope="col" class="px-4 py-2 text-center">Nama Proyek</th>
                            <th scope="col" class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $no => $pb)
                            <tr>
                                <td class="text-center">{{ $no + 1 }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($pb->tanggal)->format('d-m-Y') }}</td>
                                <td class="text-center">{{ $pb->no_nota }}</td>
                                <td class="text-center">
                                    @if ($pb->foto_nota)
                                        <img src="{{ asset('storage/' . $pb->foto_nota) }}" width="100">
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $pb->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak diketahui' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pembelian.detail', $pb->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('pembelian.delete', $pb->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Apakah yakin ingin menghapus data pembelian?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#searchProject').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</x-layout>
