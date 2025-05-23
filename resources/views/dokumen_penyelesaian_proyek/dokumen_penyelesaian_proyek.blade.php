<x-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-radius-lg">
                    <div class="card-header pb-0">
                        <h4 class="font-weight-bolder mb-0">Dokumen Penyelesaian Proyek</h4>
                    </div>

                    <div class="card-body px-4 pt-0 pb-2">

                        {{-- Bar Atas: Tombol + Pencarian --}}
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 my-4">
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('dokumen.create') }}" class="btn btn-info">
                                <i class="bi bi-plus"></i> Tambah Dokumen
                            </a>
                        </div>

                        <form action="{{ route('dokumen.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Proyek" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-default px-5"></i>Cari Dokumen </button>
                            <a href="{{ route('dokumen.index') }}" class="btn btn-secondary "><i class="bi bi-x-circle"></i></a>
                        </form>
                    </div>


                        {{-- Notifikasi sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Tabel --}}
                        @include('components.table', ['dokumen' => $dokumen])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
