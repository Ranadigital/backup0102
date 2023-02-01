<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('third_party_stylesheets')

    @stack('page_css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/images/logo.png') }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('/images/logo.png') }}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">{{ config('app.name') }}</a>.</strong> All
            rights
            reserved.
        </footer>
    </div>



    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script>
        window._token = '{{ csrf_token() }}';

        function UpdateStatus(id, status, type) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: "{{ url('admin/set-status') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    status: status,
                    type: type
                }
            }).done(function(data) {
                var htmlOption = '';
                if (data.code == 200) {
                    if (type == 'productPrimeStatus' || type == 'productImagePrimeStatus') {
                        if (status === '0') {
                            $('#prime' + id).html("<button type='button' id= 'unPrime' onclick='UpdateStatus(\"" +
                                id + "\", \"1\",\"" + type + "\")' class='btn btn-danger'>Non-Prime</button>")
                        } else {
                            $('#prime' + id).html("<button type='button' id='prime' onclick='UpdateStatus(\"" + id +
                                "\", \"0\",\"" + type + "\")' class='btn btn-success'>Prime</button>")
                        }
                    } else if (type == 'orderStatus') {
                        $('#enable' + id).html(
                            '<button type="button" id="enable"  class="btn btn-success">Deliverd</button>');
                    } else {
                        if (status === '0') {
                            $('#enable' + id).html("<button type='button' id= 'disable' onclick='UpdateStatus(\"" +
                                id + "\", \"1\",\"" + type + "\")' class='btn btn-danger'>Disable</button>")
                        } else {
                            $('#enable' + id).html("<button type='button' id='enable' onclick='UpdateStatus(\"" +
                                id + "\", \"0\",\"" + type + "\")' class='btn btn-success'>Enable</button>")
                        }
                    }

                } else {
                    $.notify({
                        title: '<strong>Failed</strong>',
                        message: data.message
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        },
                    });
                }
            });
        }

        $(document).ready(function() {
            // $.noConflict();
            var table = $('#dataTableLength').DataTable();
            // $('#dataTableLength').DataTable( {
            //     "ajax": "/jalil/public/data.json"
            // } );
        });
    </script>


    @stack('third_party_scripts')

    @stack('page_scripts')

    @stack('js')

</body>

</html>
