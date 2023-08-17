<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CEMIN</title>

        <!-- Custom fonts for this template
        <link href="{{asset('vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
-->
        <!-- Imports 
        <link href="{{ asset('vendor/datatables/css/datatables.min.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
-->

        <!-- Custom styles for this template-->
        @include('layouts.vertical.styles')
        <style>
            @media screen and (max-width: 1980px) {
                .full_screen{
                    padding-left:55%;
                    padding-top:0%;
                }

                .wrapper{
                    background-image: url({{asset('assets/images/brand/fondo-login.png')}}); 
                    background-size:100% 100%; 
                    background-repeat:no-repeat;
                }
            }
            @media screen and (max-width: 900px) {
                .full_screen{
                    padding-left:0%;
                    padding-top:0%;
                }

                .wrapper{
                    background-image: url({{asset('assets/images/brand/fondo-login_old.png')}});
                }
            }
        </style>

    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div class="wrapper" >
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="align-self-center d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Content Row -->
                        <div class="row justify-content-md-center">
                            @yield('content')
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
    </body>
    
    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('vendor/jquery/js/jquery-3.6.0.min.js')}}"></script> --}}

    <!--
    <script src="{{asset('vendor/popper/js/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/js/datatables.min.js')}}"></script>
    <script src="{{asset('vendor/fontawesome/js/all.min.js')}}"></script>
    -->
    <!-- Custom scripts for all pages
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
-->
    @stack('custom_scripts')
</html>