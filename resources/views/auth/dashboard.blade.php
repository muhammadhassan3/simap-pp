<x-layout>

    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white;">
            <h2>Dashboard</h2>
            <p>Selamat datang {{ $user->username ?? 'Username' }}.</p>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-4">

                <!-- Proposal Card -->
                <div class="col">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h6 class="text-uppercase text-primary fw-bold mb-1">Proposal</h6>
                                    <h4 class="fw-semibold text-dark">{{ $countProposal }}</h4>
                                </div>
                                <i class="fas fa-calendar fa-2x text-primary opacity-25"></i>
                            </div>
                            <a href="{{ route('pengajuan_proposal.index') }}"
                                class="btn btn-sm btn-primary mt-auto w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Proyek Berjalan Card -->
                <div class="col">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="mb-3">
                                <h6 class="text-uppercase text-warning fw-bold mb-1">Proyek Berjalan</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="fw-semibold text-dark mb-0">{{ $countProjekBerjalan }}</h4>
                                    <i class="fas fa-clipboard-list fa-2x text-warning opacity-25"></i>
                                </div>
                            </div>
                            <a href="{{ route('proyekdisetujui.index') }}" class="btn btn-sm btn-warning mt-auto w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Proyek Selesai Card -->
                <div class="col">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h6 class="text-uppercase text-info fw-bold mb-1">Proyek Selesai</h6>
                                    <h4 class="fw-semibold text-dark">{{ $countProjekSelesai }}</h4>
                                </div>
                                <i class="fas fa-check-circle fa-2x text-info opacity-25"></i>
                            </div>
                            <a href="{{ route('proyekdisetujui.index') }}"
                                class="btn btn-sm btn-info text-white mt-auto w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    
</x-layout>
