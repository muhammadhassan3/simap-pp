<x-layout>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tambah Jadwal Proyek</title>
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
                    <h4 class="mb-0">Tambah Jadwal</h4>
                </div>

                <form id="tambah-form" action="/penjadwalan_proyek/store" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_proyek_disetujui" class="form-label">Nama Proyek</label>
                        <select class="form-select" name="id_proyek_disetujui" id="id_proyek_disetujui" required readonly>
                                <option value="{{ $proyekDisetujui->id }}"
                                        data-tanggal-mulai="{{ $proyekDisetujui->tanggal_mulai }}"
                                        data-tanggal-selesai="{{ $proyekDisetujui->tanggal_selesai }}" selected>
                                    {{ $proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}
                                </option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai_display" class="form-label">Tanggal Mulai Proyek</label>
                            <input type="date" class="form-control" id="tanggal_mulai_display" name="tanggal_mulai_display"
                                @if($idProyekDisetujui) value="{{ \Carbon\Carbon::parse($proyekDisetujui->tanggal_mulai)->format('Y-m-d') }}" @endif
                                disabled readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai_display" class="form-label">Tanggal Selesai Proyek</label>
                            <input type="date" class="form-control" id="tanggal_selesai_display" name="tanggal_selesai_display"
                                @if($idProyekDisetujui) value="{{ \Carbon\Carbon::parse($proyekDisetujui->tanggal_selesai)->format('Y-m-d') }}" @endif
                                disabled readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="supervisor" class="form-label">Supervisor</label>
                        <input type="text" class="form-control" id="supervisor" disabled readonly value="{{$supervisor}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Kegiatan</label>
                            <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Kegiatan</label>
                            <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <textarea class="form-control" name="pekerjaan" rows="4" placeholder="Input pekerjaan"
                                  required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="sedang dikerjakan">Sedang Dikerjakan</option>
                            <option value="batal">Batal</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary w-100" onclick="konfirmasiTambah()">Simpan Jadwal
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function getProyekDetails() {
            let select = document.getElementById("id_proyek_disetujui");
            let selectedOption = select.options[select.selectedIndex];
            let tanggalMulai = selectedOption.getAttribute("data-tanggal-mulai");
            let tanggalSelesai = selectedOption.getAttribute("data-tanggal-selesai");

            document.getElementById("tanggal_mulai_display").value = formatDate(tanggalMulai);
            document.getElementById("tanggal_selesai_display").value = formatDate(tanggalSelesai);

            // Get supervisor details
            if (select.value) {
                fetch(`/get-supervisor/${select.value}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.supervisor && data.supervisor.pekerja) {
                            document.getElementById("supervisor").value = data.supervisor.pekerja.nama;
                            document.getElementById("id_tim_project").value = data.supervisor.id;
                        } else {
                            document.getElementById("supervisor").value = 'Supervisor tidak ditemukan';
                            document.getElementById("id_tim_project").value = '';
                        }
                    })
                    .catch(error => {
                        console.error("Error Fetching Supervisor:", error);
                        document.getElementById("supervisor").value = 'Error mengambil data supervisor';
                        document.getElementById("id_tim_project").value = '';
                    });
            } else {
                document.getElementById("supervisor").value = '';
                document.getElementById("id_tim_project").value = '';
            }
        }

        document.getElementById("tanggal_mulai").addEventListener("change", validateTanggalKegiatan);
        document.getElementById("tanggal_selesai").addEventListener("change", validateTanggalKegiatan);

        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-EN');
        }

        function validateTanggalKegiatan() {
            let tanggalMulai = document.getElementById("tanggal_mulai").value;
            let tanggalSelesai = document.getElementById("tanggal_selesai").value;

            if (tanggalMulai && tanggalSelesai) {
                // Convert dates to timestamp for comparison
                let mulai = new Date(tanggalMulai).getTime();
                let selesai = new Date(tanggalSelesai).getTime();

                if (selesai < mulai) {
                    Swal.fire({
                        title: "Kesalahan!",
                        text: "Tanggal selesai tidak boleh lebih awal dari tanggal mulai",
                        icon: "error"
                    });
                    document.getElementById("tanggal_selesai").value = '';
                }
            }
        }

        function konfirmasiTambah() {
            Swal.fire({
                title: "Simpan Jadwal?",
                text: "Apakah Anda yakin ingin menyimpan jadwal ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("tambah-form").submit();
                }
            });
        }
    </script>


    </body>

    </html>
</x-layout>
