<x-layout>

    <form action='{{ url('aktor') }}' method='post'>
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- JUDUL -->
            <h2 class="mb-3">Tambah Data User</h2>
            <a href='{{ url('aktor') }}' class="btn btn-secondary">
                << kembali </a>
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username" value=""
                                autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10 position-relative">
                            <input type="password" class="form-control" name="password" id="password" value=""
                                autocomplete="new-password" readonly>
                            <span id="togglePassword"
                                class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer">
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='email' id="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="role">
                                <option value="">-- Pilih Role --</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="staff">Staff</option>
                                <option value="pekerja">Pekerja</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                        </div>
                    </div>
        </div>

        <!-- Tambahkan FontAwesome untuk ikon -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!-- Tambahkan FontAwesome untuk ikon -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let username = document.getElementById('username');
                let password = document.getElementById('password');

                // Kosongkan input saat halaman dimuat
                username.value = '';
                password.value = '';

                // Hapus readonly setelah halaman selesai dimuat
                setTimeout(() => {
                    username.removeAttribute('readonly');
                    password.removeAttribute('readonly');
                }, 500);
            });

            // Fitur toggle password
            document.getElementById('togglePassword').addEventListener('click', function() {
                let passwordInput = document.getElementById('password');
                let icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        </script>

    </form>
</x-layout>
