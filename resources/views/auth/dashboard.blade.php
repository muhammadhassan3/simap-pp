<x-layout>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0" style="background: white">
                <h2>Dashboard</h2>
                <p>Selamat datang {{ $user->username ?? 'No Name' }}.</p>

                <div class="container mb-10 p-0">
                    <div class="gap-2 d-flex p-1" style="width: 100%">
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                <h5 class="card-title">Proposal</h5>
                                <p class="card-text">{{ $countProposal }}</p>
                                <a href="{{ route('pengajuan_proposal.index') }}" class="btn btn-primary">Proposal</a>
                            </div>
                        </div>
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                <h5 class="card-title">Proyek Berjalan</h5>
                                <p class="card-text">{{ $countProjekBerjalan }}</p>
                                <a href="{{ route('proyekdisetujui.index') }}" class="btn btn-primary">Proyek</a>
                            </div>
                        </div>
                        <div class="card" style="width: 100%">
                            <div class="card-body">
                                <h5 class="card-title">Proyek Selesai</h5>
                                <p class="card-text">{{ $countProjekSelesai }}</p>
                                <a href="{{ route('proyekdisetujui.index') }}" class="btn btn-primary">Proyek</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
