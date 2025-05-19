<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tempat Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="{{route("save-tempat-proyek")}}" enctype="multipart/form-data" method="post">
    @csrf
    <div style="display: flex; flex-direction: row">
        <p>Nama Tempat</p>
        <input type="text" name="nama_tempat">
    </div>
    <div style="display: flex; flex-direction: row">
        <p>Alamat Tempat</p>
        <textarea name="alamat"></textarea>
    </div>
    <div>
        <p>Customer</p>
        <select name="id_customer">
            <option value="-1" disabled selected>Pilih</option>
            <option value="1">PT Pertamina Persero</option>
        </select>
    </div>
    <div style="display: flex; flex-direction: row">
        <div>
            <p>Foto</p>
            <input type="file" name="foto">
        </div>
        <div>
            <p>kategori Proyek</p>
            <select name="id_kategori_proyek">
                <option value="-1" disabled selected>Pilih</option>
                <option value="1">Konstruksi</option>
            </select>
        </div>
    </div>
    <input type="submit" value="Tambah Tempat Proyek">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
