<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    @yield('css')
    <style>
        .btn-purple{
        background: #008238;
        border: 1px solid #008238;
        color: white;
        }
        .btn-purple:hover{
        background: #008238;
        border: 1px solid #008238;
        color: white;
    }
    </style>

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="mb-0">PEKAT</h3>
                <p class="text-white mb-0">Pengaduan Masyarakat</p>
            </div>

            <ul class="list-unstyled components">
                <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                    <a href="{{route('dashboard.index')}}">Dashboard</a>
                </li>
                <li class="{{Request::is('admin/pengaduan') ? 'active' : ''}}">
                    <a href="{{route('pengaduan.index')}}">Pengaduan</a>
                </li>
                <li class="{{Request::is('admin/petugas') ? 'active' : ''}}">
                    <a href="{{route('petugas.index')}}">Petugas</a>
                </li>
                <li class="{{Request::is('admin/masyarakat') ? 'active' : ''}}">
                    <a href="{{route('masyarakat.index')}}">Masyarakat</a>
                </li>
                <li class="{{Request::is('admin/laporan') ? 'active' : ''}}">
                    <a href="{{route('laporan.index')}}">Laporan</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="ml-2">@yield('header')</div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <a href="#" class="btn btn-white btn-sm" data-toggle="modal" data-target="#logoutModal">{{ Auth::guard('admin')->user()->nama_petugas }}</a>
                        </ul>
                    </div>  
                </div>
            </nav>
            @yield('content')
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ route('admin.logout') }}" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    <script>
        function confirmLogout() {
            $('#logoutModal').modal('show');
        }
    </script>
    @yield('js')
</body>

</html>