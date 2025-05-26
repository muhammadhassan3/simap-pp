<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <!-- JUDUL HALAMAN -->
                <h2 class="mb-3">Daftar User</h2>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pb-3">
                    <!-- TOMBOL TAMBAH DATA -->
                    <a href="{{ url('aktor/create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah User
                    </a>

                    <!-- FORM PENCARIAN -->
                    <form class="d-flex align-items-stretch gap-2" action="{{ url('aktor') }}" method="get">
                        <input class="form-control" type="search" name="katakunci"
                            value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci"
                            aria-label="Search" style="min-width: 250px; height: 40px;">
                        <button class="btn btn-secondary d-flex align-items-center px-3" type="submit">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </form>

                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th class="col-md-1 text-center">No</th>
                                <th class="col-md-1">Username</th>
                                <th class="col-md-4">Email</th>
                                <th class="col-md-2">Role</th>
                                <th class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = $data->firstItem(); ?>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <!-- Tombol Edit dengan ikon Pensil -->
                                        <a href="{{ url('aktor/' . $item->username . '/edit') }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Tombol Hapus dengan ikon Tempat Sampah -->
                                        <form onsubmit="return confirm('Yakin ingin menghapus data?')" class="d-inline"
                                            action="{{ url('aktor/' . $item->username) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

</x-layout>
