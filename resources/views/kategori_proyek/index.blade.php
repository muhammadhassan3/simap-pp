@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
    <h3 class="mb-3 text-center">Kategori Proyek</h3>
    <div class="row mb-3 pt-4">
        <div class="col-md-9">
            <!-- Search Form -->
            <form action="{{ route('kategori_proyek.index') }}" method="GET" class="d-flex w-100">
                <div class="input-group w-100">
                    <input type="text" id="searchInput" class="search-box" style="width: 90%;" placeholder="Cari kategori proyek ..." onkeyup="searchTable()">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-3 text-end">
            <!-- Tombol Tambah -->
            <a href="{{ route('kategori_proyek.create') }}" class="btn btn-primary">+ Tambah Kategori Proyek</a>
        </div>
    </div>

    <div class="table-responsive pt-2">
        <table class="table">
            <thead class="table">
                <tr class="text-center">
                    <th>NO</th>
                    <th>NAMA KATEGORI</th>
                    <th>KETERANGAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($kategoris as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Gunakan index biasa -->
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-center">
                        <!-- Edit -->
                        <a href="{{ route('kategori_proyek.edit', $item->id) }}"
                            class="btn btn-sm" style="background-color: #DEAA00;">
                            <i class="bi bi-pencil-fill text-white"></i>
                        </a>

                        <!-- Hapus -->
                        <a href="javascript:void(0);" class="btn btn-sm text-white" style="background-color: #DE3F00;"
                            data-url="{{ route('kategori_proyek.destroy', $item->id) }}"
                            onclick="showDeleteModal(this)">
                            <i class="bi bi-trash-fill text-white"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('kategori_proyek.delete')

<script>
    function searchTable() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let rows = document.querySelectorAll("tbody tr");
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
@endsection