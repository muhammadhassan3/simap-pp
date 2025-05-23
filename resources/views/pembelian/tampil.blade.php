<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .btn-sm-custom {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .input-group .form-control {
            height: calc(1.8125rem + 2px);
            font-size: 0.875rem;
        }

        .input-group-text {
            height: calc(1.8125rem + 2px);
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow mb-5 rounded">
            <div class="card-header bg-light">
                <h2 class="mb-3">Tabel Pembelian</h2>

                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('pembelian.tambah') }}" class="btn btn-primary btn-sm">+ Tambah Pembelian</a>

                    <!-- Form Pencarian -->
                    <form class="d-flex" style="flex-grow: 1; max-width: 500px;">
                        <div class="input-group w-80">
                            <input type="search" id="searchProject" class="form-control"
                                placeholder="Cari berdasarkan Tanggal atau Nama Proyek" aria-label="Search">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-center">NO</th>
                            <th scope="col" class="px-4 py-2 text-center">TANGGAL</th>
                            <th scope="col" class="px-4 py-2 text-center">NO NOTA</th>
                            <th scope="col" class="px-4 py-2 text-center">NOTA</th>
                            <th scope="col" class="px-4 py-2 text-center">NAMA PROYEK</th>
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
                                    <a href="{{ route('pembelian.detail', $pb->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('pembelian.delete', $pb->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger"
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

</body>

</html>
