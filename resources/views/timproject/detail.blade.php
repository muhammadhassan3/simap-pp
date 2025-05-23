<x-layout>
    <div class="container mt-4">
        <h2 class="mb-3">Detail Tim Proyek</h2>

        <!-- Form Pencarian -->
        <form action="{{ route('tim-proyek.detail', ['id' => $id]) }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama pekerja..." style="height: 40px;">
                <button type="submit" class="btn btn-primary" style="height: 40px;">Cari</button>
            </div>
        </form>
        

        

        <div class="card">
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead class="text-secondary">
                        <tr>
                            <th>Nama Pekerja</th>
                            <th>Peran</th>
                            <th>Keahlian</th>
                            <th class="text-center" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tim as $t)
                        <tr>
                            <td>{{ $t->pekerja->nama }}</td>
                            <td class="text-capitalize">{{ $t->peran }}</td>
                            <td>{{ $t->keahlian }}</td>
                            <td class="text-center">
                                <a href="{{ route('tim-proyek.edit', $t->id) }}" class="btn btn-warning btn-md rounded-2 px-3 py-2">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('tim-proyek.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tim ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md rounded-2 px-3 py-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada hasil ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>