<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="card mt-3 w-50 p-4 shadow-sm">
    <div class="container d-flex align-items-center">
        <div class="profile-card">
            <h4 class="fw-semibold">Informasi Profil</h4>
            <p class="text-muted">Update informasi akun anda seperti Username dan Email</p>

            <form action="{{route('updateprofile')}}" method="POST"> 
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label ">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{$user->username}}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label ">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
                </div>

                <button type="submit" class="btn btn-primary px-4">Save</button>
            </form>
        </div>
    </div>
</div>

<div class="card mt-3 w-50 p-4 shadow-sm">
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

<div class="card mt-3 w-50 p-4 shadow-sm">
    <div class="container d-flex align-items-center">
        <div class="profile-card">
            <h4 class="fw-semibold">Hapus Akun</h4>
            <p class="text-muted">Tindakan ini tidak dapat mengembalikan akun anda. Pastikan anda sudah yakin untuk menghapus akun</p>


                <form action="{{ route('deleteaccount') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan!')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </form>

            </form>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

    </body> 

</html>