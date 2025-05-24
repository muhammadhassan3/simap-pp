   @extends('layout.template')

   <!-- START DATA -->
   @section('konten')
       <div class="my-3 p-3 bg-body rounded shadow-sm">
           <!-- JUDUL HALAMAN -->
           <h2 class="mb-3">Daftar User</h2>
           <!-- FORM PENCARIAN -->
           <div class="pb-3">
               <form class="d-flex" action="{{ url('aktor') }}" method="get">
                   <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                       placeholder="Masukkan kata kunci" aria-label="Search">
                   <button class="btn btn-secondary" type="submit">Cari</button>
               </form>
           </div>

           <!-- TOMBOL TAMBAH DATA -->
           <div class="pb-3">
               <a href='{{ url('aktor/create') }}' class="btn btn-primary">+ Tambah User</a>
           </div>

           <table class="table table-striped">
               <thead>
                   <tr>
                       <th class="col-md-1">No</th>
                       <th class="col-md-1">Username</th>
                       <th class="col-md-3">Password</th>
                       <th class="col-md-4">Email</th>
                       <th class="col-md-2">Role</th>
                       <th class="col-md-2">Aksi</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $i = $data->firstItem(); ?>
                   @foreach ($data as $item)
                       <tr>
                           <td>{{ $i }}</td>
                           <td>{{ $item->username }}</td>
                           <td>{{ $item->password }}</td>
                           <td>{{ $item->email }}</td>
                           <td>{{ $item->role }}</td>
                           <td>
                               <!-- Tombol Edit dengan ikon Pensil -->
                               <a href="{{ url('aktor/' . $item->username . '/edit') }}" class="btn btn-warning btn-sm">
                                   <i class="fas fa-edit"></i>
                               </a>

                               <!-- Tombol Hapus dengan ikon Tempat Sampah -->
                               <form onsubmit="return confirm('Yakin ingin menghapus data?')" class="d-inline"
                                   action="{{ url('aktor/' . $item->username) }}" method="post">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                       <i class="fas fa-trash"></i>
                                   </button>
                               </form>
                           </td>
                       </tr>
                       <?php $i++; ?>
                   @endforeach
               </tbody>
           </table>
           {{ $data->links() }}
       </div>
       <!-- AKHIR DATA -->
   @endsection
