@extends('layouts.app')

@section('content')

<!-- Garis Pembatas -->
<hr class="mt-0 mb-2">

<!-- Judul Halaman -->
<h3 class="fw-bold mb-3">Monitoring Proyek</h3>

<br>
<!-- Judul Section -->
<h5 class="fw-normal">Tempat Proyek</h5>
<!-- Garis Pembatas -->
<hr class="mt-0 mb-3">

<!-- Tempat Proyek -->
<div class="row mb-4 gap-4" style="margin-left: 10px;">

    <!-- Kolom Foto atau Placeholder -->
    <div class="col-md-4 p-4 d-flex align-items-center justify-content-center" style="border: 2px solid black; border-radius: 12px; max-width: 350px; height: 100%;">
        <div class="img-container d-flex align-items-center justify-content-center mb-3 w-100" style="max-height: 150px; min-height: 150px;">
            @if($monitoringProyek && $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto)
            <img src="{{ asset('storage/' . $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto) }}" class="img-fluid rounded" alt="Foto Proyek" style="max-width: 100%; max-height: 150px; object-fit: contain;">
            @else
            <p class="text-muted text-center m-0">Belum ada foto</p>
            @endif
        </div>
    </div>

    <!-- Kolom Detail Proyek -->
    <div class="col-md-7 p-4" style="border: 2px solid black; border-radius: 12px; display: flex; flex-direction: column; justify-content: center;">
        @if($monitoringProyek)
        <strong class="mb-3" style="font-size: 1.3rem;">{{ strtoupper($monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->nama) }}</strong>
        <div style="display: grid; grid-template-columns: 150px 10px auto; gap: 8px 12px;">
            <span style="font-weight: 600;">Kategori</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->kategoriProyek->nama ?? '-' }}</span>
            <span style="font-weight: 600;">Customer</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->customer->nama ?? '-' }}</span>
            <span style="font-weight: 600;">Alamat</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->alamat ?? '-' }}</span>
            <span style="font-weight: 600;">Jangka Waktu</span><span>:</span>
            @if($monitoringProyek->Proyek_disetujui->tanggal_mulai && $monitoringProyek->Proyek_disetujui->tanggal_selesai)
            <span>{{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_mulai)) }} s/d {{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)) }}</span>
            @else
            <span>-</span>
            @endif
        </div>
        @else
        <strong class="mb-3" style="font-size: 1.2rem;">Data Proyek Tidak Tersedia</strong>
        <div style="display: grid; grid-template-columns: 150px 10px auto; gap: 8px 12px;">
            <span style="font-weight: 600;">Kategori</span><span>:</span><span>-</span>
            <span style="font-weight: 600;">Customer</span><span>:</span><span>-</span>
            <span style="font-weight: 600;">Alamat</span><span>:</span><span>-</span>
            <span style="font-weight: 600;">Jangka Waktu</span><span>:</span><span>-</span>
        </div>
        @endif
    </div>

</div>

<!-- Penjadwalan -->
<h5 class="fw-normal">Timeline</h5>
<!-- Garis Pembatas -->
<hr class="mt-0 mb-0">
<div class="table-responsive">
    <table class="table table-bordered" id="timelineTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Nama Proyek</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                <th>Status Review</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($monitoringProyek && $monitoringProyek->penjadwalan && $monitoringProyek->penjadwalan->isNotEmpty())
            @foreach($monitoringProyek->penjadwalan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tanggal_mulai)) }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tanggal_selesai)) }}</td>
                <td>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->nama ?? 'Tidak Ada Nama Proyek' }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td class="{{ strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai) ? 'text-danger' : 'text-success' }}">
                    {{ strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai) ? 'failure' : 'BH' }}
                </td>
                <td class="{{ $item->keterangan ? 'text-grey' : 'text-danger' }}">
                    {{ $item->keterangan ? 'Sudah Direview' : 'Belum Direview' }}
                </td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('monitoring_proyek.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('monitoring_proyek.reset', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin melakukan reset?')">Reset</a>
                        <a href="" class="btn btn-secondary btn-sm">Detail</a>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9" class="text-center">Tidak ada data penjadwalan</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<br>

<!-- Tim Proyek -->
<h5 class="fw-normal">Tim Proyek</h5>
<!-- Garis Pembatas -->
<hr class="mt-0 mb-0">
<div class="table-responsive">
    <table class="table table-bordered" id="timProyekTable" style="width:100%">
        <thead>
            <tr>
                <th style="width: 7%">No</th>
                <th style="width: 45%">Nama Pekerja</th>
                <th style="width: 50%">Peran</th>
            </tr>
        </thead>
        <tbody>
            @if($monitoringProyek && $monitoringProyek->timProyek->isNotEmpty())
            @foreach($monitoringProyek->timProyek as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pekerja->nama ?? '-' }}</td>
                <td>{{ $item->peran ?? '-' }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center">Tidak ada data tim proyek.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Java Script untuk pencarian pada tabel timeline memanggil id="timelineTable" -->
<!-- Tambahkan pustaka DataTables dan Bootstrap 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function() {
        $('#timelineTable').DataTable({
            "searching": true,
            "paging": true,
            "info": true
        });

        $('#timProyekTable').DataTable({
            "searching": true,
            "paging": true,
            "info": true
        });
    });
</script>

@endsection