<x-layout>
    @if($errors->any())
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
    <a href="{{ route('show-tempat-proyek') }}" class="d-flex gap-2 text-dark me-2">
        <i class="bi bi-arrow-left fs-4"></i>
        <p class="text-start">Kembali</p>
    </a>
    <form action="{{route("save-tempat-proyek")}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3 flex-row d-flex">
            <label for="namaTempat" class="col-sm-2 col-form-label">Nama Tempat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namaTempat" name="nama_tempat">
            </div>
        </div>
        <div class="mb-3 flex-row d-flex">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat Tempat</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control" id="alamat" name="alamat"></textarea>
            </div>
        </div>
        <div class="mb-3 flex-row d-flex">
            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
            <select name="id_customer" class="form-select" aria-label="Default select example">
                <option value="-1" disabled selected>Pilih</option>
                @foreach($customer as $item)
                    <option value="{{$item->id}}">{{$item->nama_customer}}</option>
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
                    @foreach($kategoriProyek as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="submit" value="Tambah Tempat Proyek" class="btn btn-primary w-100">
    </form>
</x-layout>
