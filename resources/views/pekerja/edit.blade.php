<x-layout>
    <div class="container py-4" style="width: 100%; max-width: 1200px;">
        <div class="row justify-content-center">
            <div>
                <div style="background: white; border-radius: 20px; padding: 30px;">
                    <h5 class="text-dark fw-semibold mb-4">Ubah Pekerja</h5>

                    <div class="row">
                        <form action="{{ route('pekerja.update', $pekerja->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $pekerja->id }}">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pekerja</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ $pekerja->nama }}" style="border-radius: 10px; padding: 10px 15px;"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="no_hp" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ $pekerja->no_hp }}" style="border-radius: 10px; padding: 10px 15px;"
                                    required>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('pekerja.index') }}" class="btn btn-secondary"
                                    style="border-radius: 10px; padding: 10px 24px;">Batal</a>
                                <button type="submit" class="btn text-white"
                                    style="background-color: #007ADE; border-radius: 10px; padding: 10px 24px;">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
