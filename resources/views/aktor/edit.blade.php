<x-layout>
    <form action='{{ url('aktor/'.$data->username) }}' method='post'>
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- JUDUL -->
            <h2 class="mb-3">Edit Data User</h2>
            <a href='{{ url('aktor') }}' class="btn btn-secondary"><< kembali </a>
            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='username' value="{{ $data->username }}" id="username">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10 position-relative">
                    <input type="text" class="form-control" name="password" id="password">
                    <span id="togglePassword"
                          class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer">
                    </span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='email' value="{{ $data->email }}" id="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10 position-relative">
                    <select class="form-control appearance-none pr-10" name="role" id="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="supervisor" {{ $data->role == 'supervisor' ? 'selected' : '' }}>Supervisor
                        </option>
                        <option value="staff" {{ $data->role == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="pekerja" {{ $data->role == 'pekerja' ? 'selected' : '' }}>Pekerja</option>

                        <span class="absolute right-3 top-3 text-gray-500">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
        </div>
        <script>
            let passwordInput = document.getElementById('password');
            let togglePassword = document.getElementById('togglePassword');
            let icon = togglePassword.querySelector('i');
            let isModified = false; // Cek apakah sudah diubah

            // Saat input berubah, ubah ke mode password (bintang-bintang)
            passwordInput.addEventListener('input', function () {
                if (!isModified) {
                    passwordInput.type = 'password'; // Ubah menjadi terenkripsi
                    isModified = true; // Tandai sudah diubah
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            // Toggle password visibility
            togglePassword.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        </script>
    </form>
</x-layout>

