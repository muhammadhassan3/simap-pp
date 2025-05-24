<x-layout>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <a href="/penjadwalan_proyek" class="text-dark me-2">
                        <i class="bi bi-arrow-left fs-4"></i>
                    </a>
                    <h4 class="mb-0">Tambah Jadwal</h4>
                </div>

                <form id="tambah-form" action="/penjadwalan_proyek/store" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_proyek_disetujui" class="form-label">Nama Proyek</label>
                        <select class="form-select" name="id_proyek_disetujui" id="id_proyek_disetujui" required
                                onchange="getProyekDetails()">
                            <option value="">-- Pilih Proyek --</option>
                            @foreach ($proyekDisetujui as $proyek)
                                <option value="{{ $proyek->id }}"
                                        data-tanggal-mulai="{{ $proyek->tanggal_mulai }}"
                                        data-tanggal-selesai="{{ $proyek->tanggal_selesai }}">
                                    {{ $proyek->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Ditemukan' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai_display" class="form-label">Tanggal Mulai Proyek</label>
                            <input placeholder="mm/dd/yyyy" type="text" class="form-control" id="tanggal_mulai_display"
                                   disabled readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai_display" class="form-label">Tanggal Selesai Proyek</label>
                            <input placeholder="mm/dd/yyyy" type="text" class="form-control"
                                   id="tanggal_selesai_display" disabled readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="supervisor" class="form-label">Supervisor</label>
                        <input type="text" class="form-control" id="supervisor" disabled readonly>
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
                            <option value="Tersedia">Tersedia</option>
                            <option value="Dikerjakan">Dikerjakan</option>
                            <option value="Batal">Batal</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary w-100" onclick="konfirmasiTambah()">Tambah Jadwal
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatTanggal(tanggal) {
            if (!tanggal) return "";

            let date = new Date(tanggal);
            let day = String(date.getDate()).padStart(2, '0');
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let year = date.getFullYear();

            return `${month}-${day}-${year}`;
        }

        function getProyekDetails() {
            let selectedOption = document.getElementById("id_proyek_disetujui").selectedOptions[0];

            let tanggalMulai = selectedOption.getAttribute("data-tanggal-mulai") || "";
            let tanggalSelesai = selectedOption.getAttribute("data-tanggal-selesai") || "";
            let proyekId = selectedOption.value;

            document.getElementById("tanggal_mulai_display").value = formatTanggal(tanggalMulai);
            document.getElementById("tanggal_selesai_display").value = formatTanggal(tanggalSelesai);
            document.getElementById("tanggal_mulai").setAttribute("min", tanggalMulai);
            document.getElementById("tanggal_selesai").setAttribute("min", tanggalMulai);

            // Ambil Supervisor via AJAX
            fetch(`/getSupervisor/${proyekId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Supervisor Response:", data); // Debugging
                    document.getElementById("supervisor").value = data.nama_supervisor || "Supervisor tidak ditemukan";
                })
                .catch(error => console.error("Error Fetching Supervisor:", error));
        }

        document.getElementById("tanggal_mulai").addEventListener("change", validateTanggalKegiatan);
        document.getElementById("tanggal_selesai").addEventListener("change", validateTanggalKegiatan);

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
</x-layout>
