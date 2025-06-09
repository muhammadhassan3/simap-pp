<nav class="navbar card navbar-expand-lg bg-white shadow-sm border-bottom px-4 py-1 rounded-3" style="height: fit-content;">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <div>
            <h6 class="mb-0 fw-bold" style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; letter-spacing: 1px;">
                SISMA
            </h6>
        </div>
        
        {{-- Kanan: Username + Dropdown --}}
        <div class="d-flex align-items-center gap-2">
            {{-- Username --}}
            <span class="fw-semibold text-dark">{{ auth()->user()->username ?? 'Username' }}</span>

            {{-- Dropdown --}}
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#"
                    id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 36px; height: 36px;">
                        <i class="bi bi-person-fill fs-5 text-dark"></i>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle me-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</nav>
