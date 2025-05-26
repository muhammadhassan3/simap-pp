<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sewa Alat Berat</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .form-control, .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            background-color: #007ADE;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Sewa Alat Berat</h2>
        <form action="{{ route('sewa_alat.update', $sewa_alat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_alat" class="form-label">Nama Alat</label>
                <input type="text" class="form-control" name="nama_alat" value="{{ $sewa_alat->nama_alat }}" required>
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" name="harga_sewa" value="{{ $sewa_alat->harga_sewa }}" required>
            </div>
            <div class="mb-3">
                <label for="customer_id" class="form-label">Nama Perusahaan</label>
                <select class="form-select" name="customer_id" required>
                    <option value="" disabled>Pilih Perusahaan</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $sewa_alat->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->nama_customer }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (menit)</label>
                <input type="number" class="form-control" name="durasi" value="{{ $sewa_alat->durasi }}" required>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" class="form-control" name="qty" value="{{ $sewa_alat->qty }}" required>
            </div>
            <div class="mb-3">
                <label for="id_proyek" class="form-label">Nama Proyek</label>
                <select class="form-select" name="id_proyek" required>
                    <option value="" disabled>Pilih Proyek</option>
                    @foreach($tempatProyek as $proyek)
                        <option value="{{ $proyek->id }}" {{ $sewa_alat->id_proyek == $proyek->id ? 'selected' : '' }}>
                            {{ $proyek->nama_tempat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" rows="3">{{ $sewa_alat->detail }}</textarea>
            </div>
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
