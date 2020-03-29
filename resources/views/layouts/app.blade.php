<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')}} | @yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('asset/img/logo.png')}}" />
      <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('asset/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/plugins/toastr/toastr.min.css')}}">

    
    <!-- jQuery -->
    <script src="{{asset('asset/css/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('asset/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('asset/js/adminlte.min.js')}}"></script>
    <!-- Google Font: Source Sans Pro -->
    <script src="{{asset('asset/css/plugins/toastr/toastr.min.js')}}"></script>
    



</head>
<body class="hold-transition login-page body">
        <main class="py-4">
            @yield('content')
        </main>

<script>
    $(document).ready(function(){
        $(".alert-error").show(function(){
            toastr.error("Username Atau Password Salah !");
            
        });
        $(".alert-sukses").show(function(){
            toastr.success("{{session('sukses')}}");
            
        });
        $(".alert-gagal").show(function(){
            toastr.error("{{session('error')}}");
            
        })
    });
</script>

</body>
</html>
