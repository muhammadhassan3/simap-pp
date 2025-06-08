<aside id="sidenav-main" class="sidenav navbar navbar-vertical bg-white navbar-expand-xs border-0 fixed-start">
    <div
        class="sidenav-header card shadow-sm m-3 d-flex justify-content-center align-items-center bg-white rounded-4 pt-0 pl-3 pb-2">
        <a class="navbar-brand d-flex justify-content-center align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('asset/Logo.png') }}" alt="main_logo" class="img-fluid"
                style="max-width: 180px; height: auto; transition: transform 0.3s ease-in-out;"
                onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        </a>
    </div>

    <hr class="horizontal dark mt-1">

    <div class="w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="{{ route('customer.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img style="width: 16px;"
                            src="https://img.icons8.com/?size=100&id=23265&format=png&color=000000" alt="">
                    </div>
                    <span class="nav-link-text ms-1">Customer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori_proyek.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img style="width: 16px;"
                            src="https://img.icons8.com/?size=100&id=7gtfJBXgkVkP&format=png&color=000000"
                            alt="">
                    </div>
                    <span class="nav-link-text ms-1">Kategori Proyek</span>
                </a>
            </li>

            {{-- MANAJEMEN PROYEK --}}
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#sidebarProyek"
                    role="button" aria-expanded="false" aria-controls="sidebarProyek">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img style="width: 16px;"
                            src="https://img.icons8.com/?size=100&id=4rMyLuvp27Oa&format=png&color=000000"
                            alt="">
                    </div>
                    <span class="nav-link-text ms-1">Manajemen Proyek</span>

                </a>
                <div class="collapse" id="sidebarProyek">
                    <ul class="list-unstyled fw-normal pb-1 small ms-2 me-2">
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('show-tempat-proyek') }}">
                                <i class="fas fa-map-marker-alt me-2"></i> Tempat Proyek
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('pengajuan_proposal.index') }}">
                                <i class="fas fa-file-alt me-2"></i> Proposal
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('proyekdisetujui.index') }}">
                                <i class="fas fa-check-circle me-2"></i> Proyek Disetujui
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('evaluasi.index') }}">
                                <i class="fas fa-clipboard-list me-2"></i> Evaluasi
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('dokumen.index') }}">
                                <i class="fas fa-folder me-2"></i> Dokumen Penyelesaian
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- MANAJEMEN PRODUK --}}
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#sidebarProduk"
                    role="button" aria-expanded="false" aria-controls="sidebarProduk">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img style="width: 16px;"
                            src="https://img.icons8.com/?size=100&id=11271&format=png&color=000000" alt="">
                    </div>
                    <span class="nav-link-text ms-1">Manajemen Produk</span>
                </a>
                <div class="collapse" id="sidebarProduk">
                    <ul class="list-unstyled fw-normal pb-1 small ms-2 me-2">
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('produk.index') }}">
                                <i class="fas fa-box-open me-2"></i> Produk
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('penjualan.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i> Penjualan
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('pembelian.tampil') }}">
                                <i class="fas fa-cart-arrow-down me-2"></i> Pembelian
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('market.index') }}">
                                <i class="fas fa-bullhorn me-2"></i> Marketing
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            {{-- MANAJEMEN TENAGA KERJA --}}
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#sidebarTenagaKerja"
                    role="button" aria-expanded="false" aria-controls="sidebarTenagaKerja">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img style="width: 16px;"
                            src="https://img.icons8.com/?size=100&id=102261&format=png&color=000000"
                            alt="worker icon">
                    </div>
                    <span class="nav-link-text ms-1">Manajemen SDM</span>
                </a>
                <div class="collapse" id="sidebarTenagaKerja">
                    <ul class="list-unstyled fw-normal pb-1 small ms-3 me-3">
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('pekerja.index') }}">
                                <i class="fas fa-user-tie me-2"></i> Pekerja
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('pengawas-proyek.index') }}">
                                <i class="fas fa-user-check me-2"></i> Pengawas
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link px-3 py-2 rounded bg-light text-dark hover:bg-primary hover:text-white transition"
                                href="{{ route('aktor.index') }}">
                                <i class="fas fa-user-cog me-2"></i> Aktor
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aktor.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">User</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
