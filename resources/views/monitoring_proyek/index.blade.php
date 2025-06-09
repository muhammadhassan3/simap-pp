<x-layout>

    <div class="card mb-4">
        <div class="card-body pb-0">

            <!-- Judul Section -->
            <h2>Tempat Proyek</h2>

            <!-- Garis Pembatas -->
            <hr class="mt-0 mb-3">

            <!-- Tempat Proyek -->
            <div class="d-flex flex-column flex-md-row mb-3" style="width: 100%">

                <!-- Kolom Foto -->
                <div class="col-md-4 d-flex justify-content-start">
                    <div class="border rounded-3 p-3 w-100 shadow-sm text-center" style="max-width: 350px;">
                        <div class="img-container d-flex align-items-center justify-content-center bg-light rounded mb-2"
                            style="height: 180px;">
                            @if (!empty($monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto))
                                <img src="{{ asset('storage/' . $monitoringProyek->Proyek_disetujui->pengajuanProposal->tempatProyek->foto) }}"
                                    class="img-fluid rounded" alt="Foto Proyek"
                                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span class="text-muted">Belum ada foto</span>
                            @endif
                        </div>
                        <small class="text-secondary">Foto Tempat Proyek</small>
                    </div>
                </div>

                <!-- Kolom Detail -->
                <div class="col-md-7" style="width: max-content">
                    <div
                        class="border rounded-3 p-4 shadow-sm bg-white h-100 d-flex flex-column justify-content-center">

                        @php
                            $proyek = $monitoringProyek->Proyek_disetujui->pengajuanProposal ?? null;
                            $tempat = $proyek->tempatProyek ?? null;
                        @endphp

                        <h5 class="fw-bold mb-3 text-uppercase">
                            {{ $tempat->nama_tempat ?? '-' }}
                        </h5>
                        <h6 class="fw-semibold text-primary mb-4">
                            {{ $proyek->nama_proyek ?? 'Nama Proyek Tidak Tersedia' }}
                        </h6>

                        <div class="row g-2">
                            <div class="col-4 fw-semibold">Kategori</div>
                            <div class="col-1">:</div>
                            <div class="col-7">{{ $tempat->kategoriProyek->nama ?? '-' }}</div>

                            <div class="col-4 fw-semibold">Customer</div>
                            <div class="col-1">:</div>
                            <div class="col-7">{{ $tempat->customer->nama_customer ?? '-' }}</div>

                            <div class="col-4 fw-semibold">Alamat</div>
                            <div class="col-1">:</div>
                            <div class="col-7">{{ $tempat->alamat ?? '-' }}</div>

                            <div class="col-4 fw-semibold">Jangka Waktu</div>
                            <div class="col-1">:</div>
                            <div class="col-7">
                                @if ($monitoringProyek->Proyek_disetujui->tanggal_mulai && $monitoringProyek->Proyek_disetujui->tanggal_selesai)
                                    {{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_mulai)) }}
                                    s/d
                                    {{ date('d-m-Y', strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)) }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

    <h5 class="fw-normal">Grafik Timeline Penjadwalan</h5>
    <!-- Grafik Status Timeline -->
    <div class="card shadow mb-4">
        <div class="card-body p-4">
            <div id="legend-container" class="d-flex justify-content-center mb-3">
                <div class="d-inline-flex align-items-center me-4">
                    <div
                        style="width:20px; height:20px; background-color:rgba(25, 118, 210, 0.85); margin-right:5px; border-radius:4px;">
                    </div>
                    <span>BH (On Time)</span>
                </div>
                <div class="d-inline-flex align-items-center">
                    <div
                        style="width:20px; height:20px; background-color:rgba(220, 53, 69, 0.85); margin-right:5px; border-radius:4px;">
                    </div>
                    <span>Failure (Late)</span>
                </div>
            </div>

            <!-- Filter Toggle Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="filterBH" data-filter="BH">
                        <i class="bi bi-check-circle"></i> Show BH
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="filterFailure"
                        data-filter="failure">
                        <i class="bi bi-x-circle"></i> Show Failure
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="filterAll" data-filter="all">
                        <i class="bi bi-eye"></i> Show All
                    </button>
                </div>
                <div class="text-muted small">
                    <span id="dataCounter">Showing 0 of 0 items</span>
                </div>
            </div>

            <div class="chart-responsive-container">
                <canvas id="timelineStatusChart"></canvas>
            </div>
        </div>
    </div>

            <!-- Penjadwalan -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-normal">Timeline</h5>
                        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
                            <a href="{{ route('penjadwalan_proyek.index', ['id_proyek_disetujui' => $monitoringProyek->id_proyek_disetujui]) }}"
                                class="btn btn-primary btn-sm mb-2">
                                <i class="bi bi-plus-circle"></i> Lihat seluruh jadwal
                            </a>
                        @endif
                    </div>

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

                            <td>{{ $monitoringProyek->Proyek_disetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada Nama Proyek' }}
                            </td>

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
                </div>
            </div>


            <!-- Garis Pembatas -->
            <hr class="mt-0 mb-0">

            <!-- Tim Proyek -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-normal">Tim Proyek</h5>
                        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
                            <a href="{{ route('tim-proyek.detail', ['id' => $monitoringProyek->id_proyek_disetujui]) }}"
                                class="btn btn-primary btn-sm mb-2">
                                <i class="bi bi-plus-circle"></i> Detail Tim
                            </a>
                        @endif
                    </div>

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
    </div></div>
            </div>

            <!-- Garis Pembatas -->
            <hr class="mt-0 mb-0">

            <!-- Sewa Alat -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <h5 class="fw-normal">Sewa Alat</h5>
                        @if ($monitoringProyek && $monitoringProyek->Proyek_disetujui)
                            <a href="{{ route('sewa_alat.index', ['id_proyek_disetujui' => $monitoringProyek->id_proyek_disetujui]) }}"
                                class="btn btn-primary btn-sm mb-2">
                                <i class="bi bi-plus-circle"></i> Lihat Penyewaan
                            </a>
                        @endif
                    </div>

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
        </table></div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <style>
            /* Chart responsive container */
            .chart-responsive-container {
                position: relative;
                width: 100%;
                min-height: 250px;
                max-height: 400px;
                overflow: hidden;
            }

            #timelineStatusChart {
                display: block;
                width: 100% !important;
                height: auto !important;
            }

            /* Filter buttons styling */
            .btn-outline-primary.active,
            .btn-outline-danger.active,
            .btn-outline-secondary.active {
                background-color: var(--bs-primary);
                border-color: var(--bs-primary);
                color: white;
            }

            .btn-outline-danger.active {
                background-color: var(--bs-danger);
                border-color: var(--bs-danger);
                color: white;
            }

            .btn-outline-secondary.active {
                background-color: var(--bs-secondary);
                border-color: var(--bs-secondary);
                color: white;
            }

            /* Chart container styles */
            .chart-container {
                position: relative;
                height: 250px;
                max-height: 400px;
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

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .chart-responsive-container {
                    min-height: 200px;
                    max-height: 300px;
                }
            }

            @media (max-width: 576px) {
                .chart-responsive-container {
                    min-height: 180px;
                    max-height: 250px;
                }

                .btn-sm {
                    font-size: 0.75rem;
                    padding: 0.25rem 0.5rem;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 10px;
                }

                .d-flex.gap-2 {
                    justify-content: center;
                }

                #dataCounter {
                    text-align: center;
                }
            }
        </style>
        <!-- Link CSS DataTables -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
        <!-- Chart.js untuk Grafik -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

        <script>
            $(document).ready(function() {
                // Function to adjust chart container height based on number of items
                function adjustChartContainerHeight(itemCount) {
                    const container = document.querySelector('.chart-responsive-container');
                    if (!container) return;

                    const minHeight = 200; // minimum height (reduced from 300)
                    const heightPerItem = 25; // height per timeline item (reduced from 40)
                    const baseHeight = 80; // base height (reduced from 100)

                    // Calculate appropriate height based on number of items
                    const calculatedHeight = Math.max(minHeight, baseHeight + (itemCount * heightPerItem));

                    // Set maximum height to prevent excessive growth
                    const maxHeight = 400; // reduced from 600
                    const finalHeight = Math.min(calculatedHeight, maxHeight);

                    // Apply the height
                    container.style.height = finalHeight + 'px';

                    // Handle small screens
                    if (window.innerWidth <= 768) {
                        container.style.height = Math.min(finalHeight * 0.8, 300) + 'px'; // reduced from 450
                    }
                    if (window.innerWidth <= 576) {
                        container.style.height = Math.min(finalHeight * 0.7, 250) + 'px'; // reduced from 350
                    }
                }

                // DataTables initialization
                $('#timelineTable').DataTable({
                    responsive: true,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "columnDefs": [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }],
                    "language": {
                        "emptyTable": "Tidak ada data yang tersedia"
                    }
                });

                $('#timProyekTable').DataTable({
                    responsive: true,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "columnDefs": [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }],
                    "language": {
                        "emptyTable": "Tidak ada data yang tersedia"
                    }
                });

                $('#sewaAlatTable').DataTable({
                    responsive: true,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "columnDefs": [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }],
                    "language": {
                        "emptyTable": "Tidak ada data yang tersedia"
                    }
                });

                // Persiapan data untuk grafik
                var timelineData = [];

                @if ($monitoringProyek && $monitoringProyek->Penjadwalan && $monitoringProyek->Penjadwalan->isNotEmpty())
                    @foreach ($monitoringProyek->Penjadwalan as $item)
                        timelineData.push({
                            tanggalMulai: '{{ date('d/m/Y', strtotime($item->tanggal_mulai)) }}',
                            tanggalSelesai: '{{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}',
                            status: '{{ $monitoringProyek->Proyek_disetujui &&
                            $monitoringProyek->Proyek_disetujui->tanggal_selesai &&
                            $item->tanggal_selesai &&
                            strtotime($item->tanggal_selesai) > strtotime($monitoringProyek->Proyek_disetujui->tanggal_selesai)
                                ? 'failure'
                                : 'BH' }}',
                            pekerjaan: '{{ str_replace("'", "\\'", $item->pekerjaan ?? '-') }}'
                        });
                    @endforeach
                @endif

                // Adjust chart container height based on timeline data
                adjustChartContainerHeight(timelineData.length);

                // Membuat grafik
                var ctx = document.getElementById('timelineStatusChart').getContext('2d');

                // Function to generate chart data
                function generateChartData(data) {
                    var chartLabels = [];
                    var chartStatusData = [];
                    var chartBackgroundColors = [];
                    var chartBorderColors = [];
                    var chartHoverBackgroundColors = [];

                    data.forEach(function(item) {
                        chartLabels.push(item.pekerjaan + ' (' + item.tanggalMulai + ' - ' + item
                            .tanggalSelesai + ')');
                        chartStatusData.push(1);

                            if (item.status === 'BH') {
                            chartBackgroundColors.push('rgba(25, 118, 210, 0.85)');
                            chartBorderColors.push('rgba(25, 118, 210, 1)');
                            chartHoverBackgroundColors.push('rgba(25, 118, 210, 1)');
                        } else {
                            chartBackgroundColors.push('rgba(220, 53, 69, 0.85)');
                            chartBorderColors.push('rgba(220, 53, 69, 1)');
                            chartHoverBackgroundColors.push('rgba(220, 53, 69, 1)');
                        }
                    });

                    return {
                        labels: chartLabels,
                        statusData: chartStatusData,
                        backgroundColors: chartBackgroundColors,
                        borderColors: chartBorderColors,
                        hoverBackgroundColors: chartHoverBackgroundColors
                    };
                }

                // Generate initial chart data
                var chartData = generateChartData(timelineData);
                var labels = chartData.labels;
                var statusData = chartData.statusData;
                var backgroundColors = chartData.backgroundColors;
                var borderColors = chartData.borderColors;
                var hoverBackgroundColors = chartData.hoverBackgroundColors;

                var timelineStatusChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Status Timeline',
                            data: statusData,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1.5,
                            borderRadius: 6,
                            maxBarThickness: 25, // reduced from 35
                            minBarLength: 5,
                            hoverBackgroundColor: hoverBackgroundColors,
                            categoryPercentage: 0.6, // Add spacing between categories
                            barPercentage: 0.7 // Add spacing between bars
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        resizeDelay: 300,
                        plugins: {
                            legend: {
                                display: false // Hide default legend
                            },
                            title: {
                                display: true,
                                text: 'Status Timeline Proyek',
                                font: {
                                    family: 'Arial, sans-serif',
                                    size: function(context) {
                                        return window.innerWidth <= 576 ? 14 : 16;
                                    },
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 20
                                },
                                color: '#333'
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleFont: {
                                    family: 'Arial, sans-serif',
                                    size: function() {
                                        return window.innerWidth <= 576 ? 12 : 14;
                                    },
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    family: 'Arial, sans-serif',
                                    size: function() {
                                        return window.innerWidth <= 576 ? 11 : 13;
                                    }
                                },
                                padding: window.innerWidth <= 576 ? 8 : 12,
                                cornerRadius: 6,
                                displayColors: true,
                                callbacks: {
                                    title: function(tooltipItems) {
                                        const label = tooltipItems[0].label;
                                        // Truncate long labels for mobile
                                        if (window.innerWidth <= 576 && label.length > 30) {
                                            return label.substr(0, 30) + '...';
                                        }
                                        return label;
                                    },
                                    label: function(context) {
                                        const index = context.dataIndex;
                                        const bgColor = context.dataset.backgroundColor[index];
                                        const isBlue = bgColor.includes('118, 210');
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
                                    autoSkip: true,
                                    maxTicksLimit: window.innerWidth <= 576 ? 2 : (window.innerWidth <= 768 ?
                                        3 : 5), // Reduced to show fewer labels with better spacing
                                    maxRotation: window.innerWidth <= 768 ? 45 : 0,
                                    minRotation: 0,
                                    padding: window.innerWidth <= 576 ? 15 : 20, // Increased padding
                                    font: {
                                        family: 'Arial, sans-serif',
                                        size: window.innerWidth <= 576 ? 9 : (window.innerWidth <= 768 ? 10 :
                                            11),
                                        weight: '500'
                                    },
                                    color: '#555',
                                    callback: function(value, index, values) {
                                        const label = this.getLabelForValue(value);
                                        let maxLength;

                                        if (window.innerWidth <= 576) {
                                            maxLength = 15;
                                        } else if (window.innerWidth <= 768) {
                                            maxLength = 25; // Increased for better readability
                                        } else {
                                            maxLength = 35; // Increased for better readability
                                        }

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
                                        size: window.innerWidth <= 576 ? 10 : 12,
                                        weight: '500'
                                    },
                                    color: '#555',
                                    padding: window.innerWidth <= 576 ? 6 : 10,
                                    callback: function(value) {
                                        return value === 1 ? 'Ya' : 'Tidak';
                                    }
                                }
                            }
                        },
                        layout: {
                            padding: {
                                left: window.innerWidth <= 576 ? 15 : 25, // Increased padding
                                right: window.innerWidth <= 576 ? 15 : 25, // Increased padding
                                top: 10, // Increased top padding
                                bottom: window.innerWidth <= 576 ? 20 :
                                    30 // Increased bottom padding for labels
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        },
                        elements: {
                            bar: {
                                maxBarThickness: window.innerWidth <= 576 ? 15 : (window.innerWidth <= 768 ?
                                    20 : 25), // reduced from 20, 25, 35
                                borderRadius: 4,
                                categoryPercentage: 0.6, // Add spacing between categories
                                barPercentage: 0.7 // Add spacing between bars
                            }
                        }
                    }
                });

                // Store original data for filtering
                var originalTimelineData = [...timelineData];

                // Filter functionality
                function filterChart(filterType) {
                    let filteredData = [];

                    if (filterType === 'all') {
                        filteredData = [...originalTimelineData];
                    } else {
                        filteredData = originalTimelineData.filter(function(item) {
                            return item.status === filterType;
                        });
                    }

                    // Generate new chart data based on filter
                    var newChartData = generateChartData(filteredData);

                    // Update chart data
                    timelineStatusChart.data.labels = newChartData.labels;
                    timelineStatusChart.data.datasets[0].data = newChartData.statusData;
                    timelineStatusChart.data.datasets[0].backgroundColor = newChartData.backgroundColors;
                    timelineStatusChart.data.datasets[0].borderColor = newChartData.borderColors;
                    timelineStatusChart.data.datasets[0].hoverBackgroundColor = newChartData.hoverBackgroundColors;

                    // Update chart height based on filtered data
                    adjustChartContainerHeight(filteredData.length);

                    // Update counter
                    updateDataCounter(filteredData.length, originalTimelineData.length);

                    // Update chart with animation
                    timelineStatusChart.update('active');
                }

                // Function to update data counter
                function updateDataCounter(showing, total) {
                    $('#dataCounter').text(`Showing ${showing} of ${total} items`);
                }

                // Filter button event handlers
                $('#filterBH').on('click', function() {
                    filterChart('BH');
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });

                $('#filterFailure').on('click', function() {
                    filterChart('failure');
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });

                $('#filterAll').on('click', function() {
                    filterChart('all');
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });

                // Set default filter to "Show All"
                $('#filterAll').addClass('active');

                // Initialize counter
                updateDataCounter(timelineData.length, timelineData.length);

                // Handle window resize for responsive chart
                let resizeTimeout;
                $(window).on('resize', function() {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(function() {
                        if (timelineStatusChart) {
                            // Update chart options for responsive behavior
                            timelineStatusChart.options.scales.x.ticks.maxTicksLimit =
                                window.innerWidth <= 576 ? 2 : (window.innerWidth <= 768 ? 3 :
                                5); // Updated to match new limits
                            timelineStatusChart.options.scales.x.ticks.maxRotation =
                                window.innerWidth <= 768 ? 45 : 0;
                            timelineStatusChart.options.scales.x.ticks.padding =
                                window.innerWidth <= 576 ? 15 : 20; // Add padding update
                            timelineStatusChart.options.elements.bar.maxBarThickness =
                                window.innerWidth <= 576 ? 15 : (window.innerWidth <= 768 ? 20 :
                                    25); // reduced from 20, 25, 35

                            // Adjust container height
                            adjustChartContainerHeight(timelineData.length);

                            // Update and resize chart
                            timelineStatusChart.update('resize');
                            timelineStatusChart.resize();
                        }
                    }, 250);
                });

                // Initial height adjustment
                adjustChartContainerHeight(timelineData.length);
            });
        </script>
    @endpush
</x-layout>
