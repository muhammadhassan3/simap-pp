<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container d-flex flex-col">
<div>
    @php
        $c = 1;
    @endphp
</div>
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0" style="background: white">
            <div style="font-size: 16px; margin-bottom: 18px" class="fw-bold">Tempat Proyek</div>
            <div class="rounded d-inline-flex flex-row p-2 flex-wrap btn mb-3"
                 style="background: #007ADE; color: white; font-size: 12px;"
                 onclick="window.location.href='{{route('add-tempat-proyek')}}'">
                + Tambah Tempat Proyek
            </div>
            <div  class="d-flex flex-row w-25 mb-1">
                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Tempat Proyek">
                <button type="button" class="btn" onclick="onSearch()">Cari</button>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-borderless" style="table-layout: auto">
                    <thead>
                    <tr class="w-100">
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Proyek
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-items-start">
                            <div class="text-nowrap">
                                Alamat
                            </div>
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <p>{{$c++}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 text-nowrap">{{$item->nama_tempat}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold text-nowrap">{{$item->alamat}}</p>
                            </td>
                            <td class="align-middle flex-row d-flex justify-content-center align-items-center">
                                <div class="d-flex flex-row justify-content-center align-items-center">
                                    <a href="{{route('edit-tempat-proyek',["id"=>$item->id])}}"
                                       class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                        </svg>
                                    </a>
                                    <div
                                       class="btn btn-sm btn-danger" style="width: 41px; height: 41px;"
                                       data-bs-toggle="modal" data-bs-target="#deleteModal"
                                       onclick="selectItem({{$item->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-trash-fill m-auto" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{--Delete Modal--}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus Tempat Proyek ini? Tempat Proyek yang dihapus tiidak dapat dikembalikan lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form method="post" id="deleteForm" action="{{route('delete-tempat-proyek')}}">
                    @csrf
                    <input type="text" name="id" value="" id="id" hidden>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
<script>
    function selectItem(id) {
        document.getElementById("id").value = id
    }
    function onSearch(i) {
        let query = document.getElementById("search").value
        if (query.length > 0) {
            window.location.href = "{{route('show-tempat-proyek')}}?search=" + query
        } else {
        }
    }
</script>
</html>
