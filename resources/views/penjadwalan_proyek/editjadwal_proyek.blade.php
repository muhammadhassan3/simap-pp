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
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <a href="/penjadwalan_proyek" class="text-dark me-2">
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


                    <!-- <div class="mb-3">
                        <label for="id_proyek_disetujui" class="form-label">Nama Proyek</label>
                        <select class="form-select" id="id_proyek_disetujui" disabled>
                            @foreach($proyekDisetujui as $proyek)
                            <option value="{{ $proyek->id }}" {{ $jadwal->id_proyek_disetujui == $proyek->id ? 'selected' : '' }}>
                                {{ $proyek->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}
                            </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="id_proyek_disetujui" value="{{ $jadwal->id_proyek_disetujui }}">
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="id_tim_project" class="form-label">Supervisor</label>
                        <select class="form-select" id="id_tim_project" disabled>
                            <option value="{{ $jadwal->timProject->id ?? '' }}" selected>
                                {{ $jadwal->timProject->pekerja->nama ?? 'Supervisor Tidak Ditemukan' }}
                            </option>
                        </select>
                        <input type="hidden" name="id_tim_project" value="{{ $jadwal->id_tim_project }}">
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label">Nama Proyek</label>
                        <input type="text" class="form-control" value="{{$proyek->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Supervisor</label>
                        <input type="text" class="form-control" value="{{$jadwal->timProject->pekerja->nama ?? 'Supervisor Tidak Ditemukan' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP Supervisor</label>
                        <input type="text" class="form-control" value="{{ $jadwal->timProject->pekerja->no_hp ?? 'No HP Tidak Ditemukan' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <textarea class="form-control" name="pekerjaan" rows="4" required>{{ $jadwal->pekerjaan }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="Tersedia" {{ $jadwal->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Dikerjakan" {{ $jadwal->status == 'Dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                            <option value="Batal" {{ $jadwal->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                            <option value="Selesai" {{ $jadwal->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
            console.log("Fungsi konfirmasiEdit dipanggil"); // Debugging
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
                    console.log("Form disubmit"); // Debugging
                    document.getElementById("edit-form").submit();
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let proyekMulai = document.getElementById("tanggal_mulai_proyek").value;
            let proyekSelesai = document.getElementById("tanggal_selesai_proyek").value;

            // Atur batas minimal pada input tanggal
            document.getElementById("tanggal_mulai").setAttribute("min", proyekMulai);
            document.getElementById("tanggal_selesai").setAttribute("min", proyekMulai);

            function validateTanggalKegiatan() {
                let tanggalMulaiKegiatan = new Date(document.getElementById("tanggal_mulai").value);
                let tanggalSelesaiKegiatan = new Date(document.getElementById("tanggal_selesai").value);
                let proyekMulaiDate = new Date(proyekMulai);

                if (tanggalMulaiKegiatan < proyekMulaiDate) {
                    Swal.fire({
                        title: "Tanggal Tidak Valid!",
                        text: "Tanggal mulai kegiatan tidak boleh lebih awal dari tanggal mulai proyek.",
                        icon: "error"
                    });
                    document.getElementById("tanggal_mulai").value = proyekMulai;
                    return;
                }

                if (tanggalSelesaiKegiatan < tanggalMulaiKegiatan) {
                    Swal.fire({
                        title: "Tanggal Tidak Valid!",
                        text: "Tanggal selesai kegiatan tidak boleh sebelum tanggal mulai kegiatan.",
                        icon: "error"
                    });
                    document.getElementById("tanggal_selesai").value = "";
                    return;
                }
            }

            document.getElementById("tanggal_mulai").addEventListener("change", validateTanggalKegiatan);
            document.getElementById("tanggal_selesai").addEventListener("change", validateTanggalKegiatan);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>