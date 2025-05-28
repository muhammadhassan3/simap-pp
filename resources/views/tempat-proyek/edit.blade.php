<x-layout>
    @if ($errors->any())
        <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(() => {
                let alertBox = document.getElementById("alert-error");
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s";
                    alertBox.style.opacity = "0";
                    setTimeout(() => alertBox.remove(), 500); // Hapus elemen setelah animasi
                }
            }, 3000); // Alert hilang setelah 3 detik
        </script>
    @endif
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <!-- Button Kembali -->
                <div>
                    <a href="{{ route('show-tempat-proyek') }}" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('save-tempat-proyek') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="text" name="id" value="{{ $data->id }}" hidden>
                    <div class="mb-3 flex-row d-flex">
                        <label for="namaTempat" class="col-sm-2 col-form-label">Nama Tempat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaTempat" name="nama_tempat"
                                value="{{ $data->nama_tempat }}">
                        </div>
                    </div>
                    <div class="mb-3 flex-row d-flex">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat Tempat</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="alamat" name="alamat">{{ $data->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 flex-row d-flex">
                        <label for="customer" class="col-sm-2 col-form-label">Customer</label>
                        <select name="id_customer" class="form-select" aria-label="Default select example">
                            <option value="-1" disabled selected>Pilih</option>
                            @foreach ($customer as $item)
                                <option value="{{ $item->id }}" @if ($data->id_customer == $item->id) selected @endif>
                                    {{ $item->nama_customer }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 flex-row d-flex">
                        <div class="me-3 w-50">
                            <label for="foto" class="col col-form-label">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                        <div class="w-100">
                            <label for="kategoriProyek" class="col col-form-label">kategori Proyek</label>
                            <select name="id_kategori_proyek" class="form-select" aria-label="Default select example">
                                <option value="-1" disabled selected>Pilih</option>
                                @foreach ($kategoriProyek as $item)
                                    <option value="{{ $item->id }}" @if ($data->id_kategori_proyek == $item->id) selected @endif>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Ubah tempat proyek" class="btn btn-primary w-100">
                </form>
            </div>
        </div>
    </div>
</x-layout>
