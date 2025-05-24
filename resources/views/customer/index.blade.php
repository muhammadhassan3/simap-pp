<x-layout>

    @section('content')
        <div class="mb-3">
            <h2 class="text-center font-weight-bold text-md">CUSTOMER</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('customer.create') }}" class="btn btn-primary">+ Tambah Customer</a>
            <div class="input-group w-auto">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari..." onkeyup="searchTable()">
            </div>
        </div>


        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>NO</th>
                            <th>NO IDENTITAS</th>
                            <th>NAMA CUSTOMER</th>
                            <th>ALAMAT</th>
                            <th>NO. HP</th>
                            <th>EMAIL</th>
                            <th width="100">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $customer->no_identitas }}</td>
                                <td class="align-middle">{{ $customer->nama_customer }}</td>
                                <td class="align-middle">{{ $customer->alamat }}</td>
                                <td class="align-middle">{{ $customer->no_hp }}</td>
                                <td class="align-middle">{{ $customer->email }}</td>
                                <td class="align-middle">
                                    <div class="pt-3 d-flex gap-1 align-items-center">
                                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm text-white"
                                            style="background-color: #DEAA00;">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #DE3F00;"
                                            data-bs-toggle="modal" data-bs-target="#hapusCustomerModal"
                                            onclick="showModalHapus({{ $customer->id }})">
                                            <i class="bi bi-trash-fill text-white"></i>
                                        </a>
                                        @include('customer.delete_cust')
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

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
</x-layout>
