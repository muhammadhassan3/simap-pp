<x-layout>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: start;
            /* Center the title */
            margin-bottom: 20px;
            /* Optional: Add some space below the title */
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-button {
            background-color: #007ADE;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .search-box {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Tombol Edit & Hapus */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-button,
        .delete-button {
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: #FFD700;
        }

        .delete-button {
            background-color: #FF4B3A;
        }

        .edit-button:hover {
            background-color: #E6C200;
        }

        .delete-button:hover {
            background-color: #D43A2A;
        }

        .edit-button svg,
        .delete-button svg {
            width: 16px;
            height: 16px;
            fill: white;
        }
    </style>
    <script>
        function confirmDelete(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                event.preventDefault();
            }
        }

        function searchTable() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

    <div class="card mb-4">
        <div class="card-body">
            <div style="margin-bottom: 15px;">
                <a href="{{ route('monitoring_proyek.index', ['id_proyek_disetujui' => $id_proyek_disetujui]) }}"
                    class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
                    </svg>
                    Kembali
                </a>
            </div>
            <h2>Data Sewa Alat Berat</h2>

            <div class="top-bar">
                <a href="/sewa_alat/create?id_proyek_disetujui={{ $id_proyek_disetujui }}" class="add-button">+ Tambah
                    Alat Berat</a>
                <input type="text" id="searchInput" class="search-box" placeholder="Cari..." onkeyup="searchTable()">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Alat</th>
                        <th>Harga Sewa</th>
                        <th>Nama Perusahaan</th>
                        <th>Durasi</th>
                        <th>Qty</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sewaAlat as $alat)
                        <tr>
                            <td>{{ $alat->id }}</td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>Rp. {{ number_format($alat->harga_sewa, 0, ',', '.') }}/jam</td>
                            <td>{{ $alat->customer->nama_customer }}</td>
                            <td>{{ $alat->durasi }} menit</td>
                            <td>{{ $alat->qty }}</td>
                            <td>{{ $alat->detail }}</td>
                            <td class="action-buttons">
                                <a href="/sewa_alat/{{ $alat->id }}/edit?id_proyek_disetujui={{ $id_proyek_disetujui }}"
                                    class="edit-button btn align-middle"
                                    style="background-color: #efb944; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                    <img style="width: 18px; height: 18px; vertical-align: middle;"
                                        src="https://img.icons8.com/?size=100&id=86374&format=png&color=FFFFFF"
                                        alt="Edit">
                                </a>
                                <form action="/sewa_alat/{{ $alat->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button btn btn-edit align-middle"
                                        onclick="confirmDelete(event)"
                                        style="background-color: #ef4444; border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; vertical-align: middle;">
                                        <img style="width: 18px; height: 18px; vertical-align: middle;"
                                            src="https://img.icons8.com/?size=100&id=DU8dSXkvLUkx&format=png&color=FFFFFF"
                                            alt="Hapus">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($sewaAlat->isEmpty())
                        <tr>
                            <td colspan="9" style="text-align: center;">Tidak ada data tersedia.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
