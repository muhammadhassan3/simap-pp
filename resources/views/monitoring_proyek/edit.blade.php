@extends('layouts.app')

@section('content')

<!-- Garis Pembatas -->
<hr class="mt-0 mb-2">

<!-- Judul Halaman -->
<h3 class="fw-bold mb-3">Edit Monitoring Proyek</h3>

<form action="{{ route('monitoring_proyek.update', $penjadwalan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $penjadwalan->keterangan ?? '') }}</textarea>
        @error('keterangan')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin menyimpan data ?')">Simpan</button>
    <a href="{{ route('monitoring_proyek.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection