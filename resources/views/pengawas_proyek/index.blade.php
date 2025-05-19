<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengawas Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light py-5">

    <div class="container d-flex justify-content-center">
        <div class="card shadow w-75">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Pengawas Proyek</h2>
                <br>
                <div class="mb-3 d-flex justify-content-start">
                    <div class="input-group w-50">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari proyek atau pekerja...">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </div>                
                
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA PROYEK</th>
                            <th class="text-center">PERAN</th>
                            <th class="text-center">NAMA PEKERJA</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        @foreach($data as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item['nama_proyek'] }}</td>
                            <td class="text-center">{{ $item['peran'] }}</td>
                            <td class="text-center">{{ $item['nama_pekerja'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('pengawas-proyek.edit', $item['id']) }}" class="btn btn-sm" style="background-color: #DEAA00;">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <script>
        // Fitur Pencarian
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let input = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
