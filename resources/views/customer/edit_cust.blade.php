<x-layout>
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 1200px; background-color: #FFFFFF">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('customer.index') }}"
                class="text-dark fw-semibold text-decoration-none d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Edit Customer
            </a>
        </div>


        <form action="{{ route('customer.update', $customers->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Method untuk update data --}}

            <div class="row">
                <div class="col-md-6">
                    <label for="no_identitas" class="form-label">No Identitas</label>
                    <input type="text" class="form-control bg-light" id="no_identitas" name="no_identitas"
                        value="{{ $customers->no_identitas }}" required>
                </div>
                <div class="col-md-6">
                    <label for="nama_customer" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control bg-light" id="nama_customer" name="nama_customer"
                        value="{{ $customers->nama_customer }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-light" id="email" name="email"
                        value="{{ $customers->email }}" required>
                </div>
                <div class="col-md-6">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control bg-light" id="no_hp" name="no_hp"
                        value="{{ $customers->no_hp }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control bg-light p-3" id="alamat" name="alamat"
                        value="{{ $customers->alamat }}" required>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-md" style="background-color: #DEAA00; color: white;">Update
                    Customer</button>
            </div>
        </form>

    </div>
</x-layout>
