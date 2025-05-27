<x-layout>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Jadwal Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

        <div class="container-fluid py-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <a href="{{ url()->previous() }}" class="text-dark me-2">
                            <i class="bi bi-arrow-left fs-4"></i>
                        </a>
                        <h4 class="mb-0">Edit Jadwal</h4>
                    </div>

                    <form id="edit-form" action="/penjadwalan_proyek/update/{{ $jadwal->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Kegiatan</label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai"
                                    value="{{ $jadwal->tanggal_mulai }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai Kegiatan</label>
                                <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai"
                                    value="{{ $jadwal->tanggal_selesai }}" required>
                            </div>
                        </div>

                        <!-- Tambahkan input hidden untuk menyimpan tanggal proyek -->
                        <input type="hidden" id="tanggal_mulai_proyek" value="{{ $jadwal->proyekDisetujui->tanggal_mulai ?? '' }}">
                        <input type="hidden" id="tanggal_selesai_proyek" value="{{ $jadwal->proyekDisetujui->tanggal_selesai ?? '' }}">
                        <input type="hidden" name="id_proyek_disetujui" value="{{ $jadwal->id_proyek_disetujui }}">

                        <div class="mb-3">
                            <label class="form-label">Nama Proyek</label>
                            <input type="text" class="form-control" value="{{ $jadwal->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Diketahui' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Supervisor</label>
                            <input type="text" class="form-control" value="{{ $timProyek->pekerja->nama ?: "Tidak Tersedia" }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP Supervisor</label>
                            <input type="text" class="form-control" value="{{ $timProyek->pekerja->no_hp ?? 'No HP Tidak Ditemukan' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <textarea class="form-control" name="pekerjaan" rows="4" required>{{ $jadwal->pekerjaan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="tersedia" {{ $jadwal->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sedang dikerjakan" {{ $jadwal->status == 'sedang dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                <option value="batal" {{ $jadwal->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                <option value="selesai" {{ $jadwal->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-warning w-100" onclick="konfirmasiEdit()">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function konfirmasiEdit() {
                Swal.fire({
                    title: "Simpan Perubahan?",
                    text: "Apakah Anda yakin ingin menyimpan perubahan jadwal ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ffc107",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, simpan",
                    cancelButtonText: "Batal",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("edit-form").submit();
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                let proyekMulai = document.getElementById("tanggal_mulai_proyek").value;
                let proyekSelesai = document.getElementById("tanggal_selesai_proyek").value;
                let inputMulai = document.getElementById("tanggal_mulai");
                let inputSelesai = document.getElementById("tanggal_selesai");

                function validateDate() {
                    let mulai = new Date(inputMulai.value);
                    let selesai = new Date(inputSelesai.value);
                    let pMulai = new Date(proyekMulai);
                    let pSelesai = new Date(proyekSelesai);

                    if (mulai > selesai) {
                        Swal.fire({
                            title: "Error!",
                            text: "Tanggal selesai tidak boleh lebih awal dari tanggal mulai",
                            icon: "error"
                        });
                        inputSelesai.value = '';
                        return false;
                    }

                    if (mulai < pMulai || selesai > pSelesai) {
                        Swal.fire({
                            title: "Error!",
                            text: "Tanggal harus berada dalam rentang waktu proyek",
                            icon: "error"
                        });
                        return false;
                    }

                    return true;
                }

                inputMulai.addEventListener("change", validateDate);
                inputSelesai.addEventListener("change", validateDate);
            });
        </script>

</body>

</html>
   </x-layout>
