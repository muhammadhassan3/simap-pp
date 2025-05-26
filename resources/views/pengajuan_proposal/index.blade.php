<x-layout>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h4 class="mb-4">Pengajuan Proposal</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2 m-0">
                        <a href="{{ route('pengajuan_proposal.create') }}" class="btn btn-primary">+ Tambah Proposal</a>
                        <a href="{{ route('proyekdisetujui.index') }}" class="btn btn-primary">Lihat Proyek Disetujui</a>
                    </div>
                    <input type="text" class="form-control w-25 mb-3" placeholder="Cari proposal..." id="searchInput">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border rounded shadow-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col" class="px-4 py-2 text-center">No.</th>
                                <th scope="col" class="px-4 py-2 text-center">Nama Proyek</th>
                                <th scope="col" class="px-4 py-2 text-center">Tempat Proyek</th>
                                <th scope="col" class="px-4 py-2 text-center">Tanggal Pengajuan</th>
                                <th scope="col" class="px-4 py-2 text-center">Harga Proyek</th>
                                <th scope="col" class="px-4 py-2 text-center">File Proposal</th>
                                <th scope="col" class="px-4 py-2 text-center">Keterangan</th>
                                <th scope="col" class="px-4 py-2 text-center">Status</th>
                                <th scope="col" class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="proposalTableBody">
                            @foreach ($proposal as $index => $p)
                                <tr class="hover:bg-[#FFFFEC]">
                                    <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-start">{{ $p->nama_proyek }}</td>
                                    <td class="px-4 py-2 text-start">{{ $p->tempat_proyek->nama_tempat ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        {{ $p->harga !== null ? 'Rp. ' . number_format($p->harga, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ asset('proposal/' . $p->file_proposal) }}" target="_blank"
                                            title="Lihat Proposal">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-start">{{ $p->keterangan ?? '-' }}</td>
                                    <td class="px-4 py-2 text-start">
                                        {{ $p->status_proposal ? ucfirst($p->status_proposal) : '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-start">
                                        <a href="{{ route('pengajuan_proposal.edit', $p->id) }}"
                                            class="btn btn-warning text-black" title="Edit Proposal">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('pengajuan_proposal.destroy', $p->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Yakin ingin menghapus proposal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus Proposal">
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
    </div>

    <!-- Link ke JS Bootstrap (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#proposalTableBody tr');

            rows.forEach(row => {
                let cells = row.getElementsByTagName('td');
                let found = false;

                for (let i = 0; i < cells.length; i++) {
                    if (cells[i]) {
                        let cellValue = cells[i].textContent || cells[i].innerText;
                        if (cellValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-layout>

</html>
