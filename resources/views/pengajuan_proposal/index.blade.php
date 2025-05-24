<x-layout>

    <div class="container mt-5">
        <h4 class="mb-4">Pengajuan Proposal</h4>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pengajuan_proposal.create') }}" class="btn btn-info">+ Tambah Proposal</a>
            <input type="text" class="form-control w-25" placeholder="Cari proposal..." id="searchInput">
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table w-100">
                        <thead>
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
                            @foreach($proposal as $index => $p)
                            <tr class="hover:bg-[#FFFFEC]">
                                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-center">{{ $p->nama_proyek }}</td>
                                <td class="px-4 py-2 text-center">{{ $p->tempat_proyek->nama_tempat ?? "-"}}</td>
                                <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 text-center">{{ 'Rp. ' . number_format($p->harga_proyek, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ asset('proposal/' . $p->file_proposal) }}" target="_blank" title="Lihat Proposal">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                </td>
                                <td class="px-4 py-2 text-center">{{ $p->keterangan_proposal }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($p->status_proposal === 'pending')
                                        <form action="{{ route('proposal.updateStatus', ['id_pengajuan_proposal' => $p->id_pengajuan_proposal, 'status' => 'disetujui']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success" title="Proposal Disetujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('proposal.updateStatus', ['id_pengajuan_proposal' => $p->id_pengajuan_proposal, 'status' => 'ditolak']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger" title="Proposal Ditolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif ($p->status_proposal === 'disetujui')
                                        <button class="btn btn-success" title="Proposal Disetujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @elseif ($p->status_proposal === 'ditolak')
                                        <button class="btn btn-danger" title="Proposal Ditolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('pengajuan_proposal.edit', $p->id_pengajuan_proposal) }}" class="btn btn-warning text-black" title="Edit Proposal">
                                        <i class="fas fa-pen"></i>
                                    </a>
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
