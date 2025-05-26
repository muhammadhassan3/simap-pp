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
            text-align: center;
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
    <div class="container">
        <h2>Data Sewa Alat Berat</h2>
        <div class="top-bar">
            <a href="/sewa_alat/create" class="add-button">+ Tambah Alat Berat</a>
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
                    <th>Nama Proyek</th>
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
                        <td>{{ $alat->tempatProyek ? $alat->tempatProyek->nama_tempat : 'Tidak Diketahui' }}</td>
                        <td>{{ $alat->detail }}</td>
                        <td class="action-buttons">
                            <a href="/sewa_alat/{{ $alat->id }}/edit" class="edit-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M14.1 4.22l5.66 5.66-9.19 9.19-5.66-5.66 9.19-9.19M15.5 3c-.4 0-.8.15-1.06.44L3.44 14.5a1.5 1.5 0 000 2.12l4.95 4.95c.29.29.67.44 1.06.44s.78-.15 1.06-.44L20.56 9.5a1.5 1.5 0 000-2.12l-4.95-4.95A1.5 1.5 0 0015.5 3z">
                                    </path>
                                </svg>
                            </a>
                            <form action="/sewa_alat/{{ $alat->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" onclick="confirmDelete(event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z">
                                        </path>
                                    </svg>
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

</x-layout>
