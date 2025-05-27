<x-layout>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="card mt-3 w-100 p-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <div class="profile-card">
                <h4 class="fw-semibold">Informasi Profil</h4>
                <p class="text-muted">Update informasi akun anda seperti Username dan Email</p>

                <form action="{{route('updateprofile')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{$user->username}}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mt-3 w-100 p-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <div class="profile-card">
                <h4 class="fw-semibold">Update Password</h4>
                <p class="text-muted">Pastikan password anda panjang dan aman</p>

                <form action="{{ route('updatepassword') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="currentpassword" class="form-label">Password Lama</label>
                        <input type="password" class="form-control" id="currentpassword" name="currentpassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="newpassword_confirmation" name="newpassword_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mt-3 w-100 p-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <div class="profile-card">
                <h4 class="fw-semibold">Hapus Akun</h4>
                <p class="text-muted">Tindakan ini tidak dapat mengembalikan akun anda. Pastikan anda sudah yakin untuk menghapus akun</p>

                <form action="{{ route('deleteaccount') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan!')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // hapus dari DOM
        });
    }, 1000);
</script>

</x-layout>
