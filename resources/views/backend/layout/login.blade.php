<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <link href="{{asset('register.css')}}" rel="stylesheet">
    <title>Login FlipBook</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


</head>

<body>
    <!-- /.login-logo -->
        <div class="card-body">
            @yield('content')
        </div>
        <!-- /.card-body -->
    <!-- /.card -->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/vendor/js/sb-admin-2.min.js')}}"></script>
    <script>
        $(function () {
            @if(Session::has('gagal'))
            toastr.error('{{Session::get('gagal')}}', 'Login Error')
            @endif

            @if(Session::has('sukses'))
            toastr.success('{{Session::get('sukses')}}', 'Notifikasi')
            @endif
        });
    </script>
    @stack('js')
</body>

</html>
