<x-layout>


    <br>
    <!-- Judul Section -->
    <h5 class="fw-normal">Tempat Proyek</h5>
    <!-- Garis Pembatas -->
    <hr class="mt-0 mb-3">

    <!-- Tempat Proyek -->
    <div class="row mb-4 gap-4" style="margin-left: 10px;">

        <!-- Kolom Foto atau Placeholder -->
        <div class="col-md-4 p-4 d-flex align-items-center justify-content-center"
            style="border: 2px solid black; border-radius: 12px; max-width: 350px; height: 100%;">
            <div class="img-container d-flex align-items-center justify-content-center mb-3 w-100"
                style="max-height: 150px; min-height: 150px;">
                @if ($monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto)
                    @if ($monitoringProyek)
                        <img src="{{ asset('storage/' . $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto) }}"
                            class="img-fluid rounded" alt="Foto Proyek"
                            style="max-width: 100%; max-height: 150px; object-fit: contain;">
                    @else
                        <p class="text-muted text-center m-0">Belum ada foto</p>
                    @endif
                @endif
            </div>
        </div>

        <!-- Kolom Detail Proyek -->
        <div class="col-md-7 p-4"
            style="border: 2px solid black; border-radius: 12px; display: flex; flex-direction: column; justify-content: center;">
            @if ($monitoringProyek)
                <strong class="mb-3"
                    style="font-size: 1.3rem;">{{ strtoupper($monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->nama_tempat ?? '-') }}</strong>
                @if ($monitoringProyek)
                    <strong class="mb-3"
                        style="font-size: 1.3rem;">{{ strtoupper($monitoringProyek->Proyek_disetujui->pengajuanProposal->nama_proyek ?? 'Nama Proyek Tidak Tersedia') }}</strong>
                    <div style="display: grid; grid-template-columns: 150px 10px auto; gap: 8px 12px;">
                        <span
                            style="font-weight: 600;">Kategori</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->kategoriProyek->nama ?? '-' }}</span>
                        <span
                            style="font-weight: 600;">Customer</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->customer->nama_customer ?? '-' }}</span>
                        <span
                            style="font-weight: 600;">Alamat</span><span>:</span><span>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->alamat ?? '-' }}</span>
                        <span style="font-weight: 600;">Jangka Waktu</span><span>:</span>
                        @if ($monitoringProyek->Proyek_disetujui->tanggal_mulai && $monitoringProyek->Proyek_disetujui->tanggal_selesai)
                            <span>{{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_mulai ?? '-')) }}
                                s/d
                                {{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai ?? '-')) }}</span>
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
            @endif
        </div>

    </div>

    <h5 class="fw-normal">Grafik Timeline Penjadwalan</h5>
    <!-- Grafik Status Timeline -->
    <div class="card shadow mb-4">
        <div class="card-body p-4">
            <div id="legend-container" class="d-flex justify-content-center mb-3">
                <div class="d-inline-flex align-items-center me-4">
                    <div style="width:20px; height:20px; background-color:rgba(25, 118, 210, 0.85); margin-right:5px; border-radius:4px;"></div>
                    <span>BH (On Time)</span>
                </div>
                <div class="d-inline-flex align-items-center">
                    <div style="width:20px; height:20px; background-color:rgba(220, 53, 69, 0.85); margin-right:5px; border-radius:4px;"></div>
                    <span>Failure (Late)</span>
                </div>
            </div>
            <canvas id="timelineStatusChart" style="height: 350px;"></canvas>
        </div>
    </div>

    <!-- Penjadwalan -->
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="fw-normal">Timeline</h5>
        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
            <a href="{{ route('penjadwalan_proyek.index', ['id_proyek_disetujui' => $monitoringProyek->id_proyek_disetujui]) }}"
                class="btn btn-primary btn-sm mb-2">
                <i class="bi bi-plus-circle"></i> Lihat seluruh jadwal
            </a>
        @endif
    </div>

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
                @if ($monitoringProyek && $monitoringProyek->Penjadwalan && $monitoringProyek->Penjadwalan->isNotEmpty())
                    @foreach ($monitoringProyek->Penjadwalan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ date('d-m-Y', strtotime($item->tanggal_mulai ?? '-')) }}</td>

                            <td>{{ date('d-m-Y', strtotime($item->tanggal_selesai ?? '-')) }}</td>

                            <td>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}</td>

                            <td>{{ $item->pekerjaan ?? '-' }}</td>

                            <td
                                class="{{ $monitoringProyek->Proyek_disetujui &&
                                $monitoringProyek->Proyek_disetujui->tanggal_selesai &&
                                $item->tanggal_selesai &&
                                strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)
                                    ? 'text-danger'
                                    : 'text-success' }}">
                                {{ $monitoringProyek->Proyek_disetujui &&
                                $monitoringProyek->Proyek_disetujui->tanggal_selesai &&
                                $item->tanggal_selesai &&
                                strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)
                                    ? 'failure'
                                    : 'BH' }}
                            </td>

                            <td class="{{ $item->keterangan ? 'text-grey' : 'text-danger' }}">
                                {{ $item->keterangan ? 'Sudah Direview' : 'Belum Direview' }}
                            </td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('monitoring_proyek.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('monitoring_proyek.reset', $item->id) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin melakukan reset?')">Reset</a>
                                    <a href="{{ route('pelaksanaan.index', $item->id) }}"
                                        class="btn btn-secondary btn-sm">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <br>

    <!-- Tim Proyek -->
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="fw-normal">Tim Proyek</h5>
        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
            <a href="{{ route('tim-proyek.detail', ['id' => $monitoringProyek->id_proyek_disetujui]) }}"
                class="btn btn-primary btn-sm mb-2">
                <i class="bi bi-plus-circle"></i> Detail Tim
            </a>
        @endif
    </div>
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
                @if ($monitoringProyek && $monitoringProyek->timProyek->isNotEmpty())
                    @foreach ($monitoringProyek->timProyek as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->pekerja->nama ?? '-' }}</td>
                            <td>{{ $item->peran ?? '-' }}</td>
                        </tr>
                    @endforeach
                 @endif
            </tbody>
        </table>
    </div>

    <!-- Sewa Alat -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h5 class="fw-normal">Sewa Alat</h5>
        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
            <a href="{{ route('sewa_alat.index', ['id_proyek_disetujui' => $monitoringProyek->id_proyek_disetujui]) }}"
                class="btn btn-primary btn-sm mb-2">
                <i class="bi bi-plus-circle"></i> Lihat Penyewaan
            </a>
        @endif
    </div>
    <!-- Garis Pembatas -->
    <hr class="mt-0 mb-0">
    <div class="table-responsive">
        <table class="table table-bordered" id="sewaAlatTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Alat</th>
                    <th>Harga Sewa</th>
                    <th>Nama Perusahaan</th>
                    <th>Durasi</th>
                    <th>Qty</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @if ($sewaAlat && $sewaAlat->isNotEmpty())
                    @foreach ($sewaAlat as $index => $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_alat }}</td>
                        <td>Rp. {{ number_format($item->harga_sewa, 0, ',', '.') }}/jam</td>
                        <td>{{ $item->customer->nama_customer ?? '-' }}</td>
                        <td>{{ $item->durasi }} menit</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->detail }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @push('scripts')
    <style>
        /* Chart container styles */
        .chart-container {
            position: relative;
            height: 400px;
            max-height: 600px;
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Ensure smooth scrolling in chart container */
        .chart-container::-webkit-scrollbar {
            width: 8px;
        }

        .chart-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .chart-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .chart-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <!-- Link CSS DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <!-- Chart.js untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>            $(document).ready(function() {
            // Function to adjust chart container height based on number of items
            function adjustChartContainerHeight(itemCount) {
                const container = document.querySelector('#timelineStatusChart').parentNode;
                const minHeight = 400; // minimum height
                const baseHeight = 100; // base height
                const heightPerItem = 30; // height per timeline item

                // Calculate appropriate height based on number of items
                const calculatedHeight = Math.max(minHeight, baseHeight + (itemCount * heightPerItem));

                // Set maximum height to prevent excessive growth
                const maxHeight = 700;
                const finalHeight = Math.min(calculatedHeight, maxHeight) + 'px';

                // Apply the height
                container.style.height = finalHeight;

                // Add scrollbar if many items
                if (calculatedHeight > maxHeight) {
                    container.style.overflowY = 'auto';
                }
            }

            // DataTables initialization
            $('#timelineTable').DataTable({
                responsive: true,
                "searching": true,
                "paging": true,
                "info": true,
                "columnDefs": [
                    { "defaultContent": "-", "targets": "_all" }
                ],
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia"
                }
            });

            $('#timProyekTable').DataTable({
                responsive: true,
                "searching": true,
                "paging": true,
                "info": true,
                "columnDefs": [
                    { "defaultContent": "-", "targets": "_all" }
                ],
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia"
                }
            });

            $('#sewaAlatTable').DataTable({
                responsive: true,
                "searching": true,
                "paging": true,
                "info": true,
                "columnDefs": [
                    { "defaultContent": "-", "targets": "_all" }
                ],
                "language": {
                    "emptyTable": "Tidak ada data yang tersedia"
                }
            });

            // Persiapan data untuk grafik
            var timelineData = [];

            @if($monitoringProyek && $monitoringProyek->Penjadwalan && $monitoringProyek->Penjadwalan->isNotEmpty())
                @foreach($monitoringProyek->Penjadwalan as $item)
                    timelineData.push({
                        tanggalMulai: '{{ date('d/m/Y', strtotime($item->tanggal_mulai)) }}',
                        tanggalSelesai: '{{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}',
                        status: '{{ $monitoringProyek->Proyek_disetujui &&
                                   $monitoringProyek->Proyek_disetujui->tanggal_selesai &&
                                   $item->tanggal_selesai &&
                                   strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)
                                   ? 'failure' : 'BH' }}',
                        pekerjaan: '{{ str_replace("'", "\\'", $item->pekerjaan ?? '-') }}'
                    });
                @endforeach
            @endif

            // Adjust chart container height based on timeline data
            adjustChartContainerHeight(timelineData.length);

            // Membuat grafik
            var ctx = document.getElementById('timelineStatusChart').getContext('2d');

            // Mengorganisasi data untuk grafik
            var labels = [];
            var statusData = [];
            var backgroundColors = [];
            var borderColors = [];
            var hoverBackgroundColors = [];

            timelineData.forEach(function(item) {
                labels.push(item.pekerjaan + ' (' + item.tanggalMulai + ' - ' + item.tanggalSelesai + ')');

                // Semua bar akan memiliki nilai 1, yang warna menjadi indikator status
                statusData.push(1);

                // Set warna berdasarkan status
                if (item.status === 'BH') {
                    backgroundColors.push('rgba(25, 118, 210, 0.85)'); // Biru untuk On Time
                    borderColors.push('rgba(25, 118, 210, 1)');
                    hoverBackgroundColors.push('rgba(25, 118, 210, 1)');
                } else {
                    backgroundColors.push('rgba(220, 53, 69, 0.85)');  // Merah untuk Late
                    borderColors.push('rgba(220, 53, 69, 1)');
                    hoverBackgroundColors.push('rgba(220, 53, 69, 1)');
                }
            });

            var timelineStatusChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Status Timeline',
                            data: statusData,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1.5,
                            borderRadius: 6,
                            maxBarThickness: 35,
                            minBarLength: 5,
                            hoverBackgroundColor: hoverBackgroundColors
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    barThickness: 25,
                    onResize: function(chart, size) {
                        // Adjust the height based on number of data points
                        const minHeight = 400;
                        const heightPerItem = 30; // pixels per item
                        const calculatedHeight = Math.max(minHeight, timelineData.length * heightPerItem);

                        // Set a maximum height to prevent excessive growth
                        const maxHeight = 600;
                        chart.height = Math.min(calculatedHeight, maxHeight);
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legend default
                        },
                        // Custom legend
                        htmlLegend: {
                            containerID: 'legend-container',
                        },
                        title: {
                            display: true,
                            text: 'Status Timeline Proyek',
                            font: {
                                family: 'Arial, sans-serif',
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 25
                            },
                            color: '#333'
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                family: 'Arial, sans-serif',
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                family: 'Arial, sans-serif',
                                size: 13
                            },
                            padding: 12,
                            cornerRadius: 6,
                            displayColors: true,
                            callbacks: {
                                title: function(tooltipItems) {
                                    return tooltipItems[0].label;
                                },
                                label: function(context) {
                                    const index = context.dataIndex;
                                    // Ambil status dari warna background
                                    const bgColor = context.dataset.backgroundColor[index];
                                    const isBlue = bgColor.includes('118, 210'); // Cek apakah warna biru (On Time)
                                    return isBlue ? 'Status: BH (On Time)' : 'Status: Failure (Late)';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: true,
                                width: 1,
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 0, // Tidak miring lagi
                                minRotation: 0,
                                padding: 12,
                                font: {
                                    family: 'Arial, sans-serif',
                                    size: 11,
                                    weight: '500'
                                },
                                color: '#555',
                                // Buat label lebih rapi dengan memotong teks yang terlalu panjang
                                callback: function(value, index, values) {
                                    const label = this.getLabelForValue(value);
                                    const maxLength = 25; // Increase character limit slightly
                                    if (label.length > maxLength) {
                                        return label.substr(0, maxLength) + '...';
                                    }
                                    return label;
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: 1,
                            border: {
                                display: true,
                                width: 1,
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.07)',
                                lineWidth: 0.5
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: 'Arial, sans-serif',
                                    size: 12,
                                    weight: '500'
                                },
                                color: '#555',
                                padding: 10,
                                callback: function(value) {
                                    return value === 1 ? 'Ya' : 'Tidak';
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 15,
                            right: 15,
                            top: 5,
                            bottom: 15
                        },
                        autoPadding: true
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Handle window resize for responsive chart
            $(window).on('resize', function() {
                if (timelineStatusChart) {
                    timelineStatusChart.resize();
                    adjustChartContainerHeight(timelineData.length);
                }
            });
        });
    </script>
    @endpush
</x-layout>
