<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</head>
<body class="bg-light">
    {{-- <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-white vh-100 position-fixed shadow" style="width: 250px;">

    </div>    

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white px-4 py-4" style="margin-left: 250px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">  
    
    </nav> --}}

    <!-- Main Content -->
    <div class=" container justify-content-center">
        <div class="card mt-5 w-80 p-4">

            @yield('content')
        </div>
    </div>
    

    {{-- <div class="p-4 mt-3" style="margin-left: 250px">
        @yield('content')
    </div> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>