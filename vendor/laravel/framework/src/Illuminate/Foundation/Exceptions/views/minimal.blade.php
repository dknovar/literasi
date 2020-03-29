<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        
    <!-- using online links -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="shortcut icon" type="image/png" href="{{asset('asset/img/user.jpeg')}}" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    </head>
    <body>
<div class="tidakditemukan text-center">
          
                    <div class="error-template">
        @yield('code')

</div>
</div>
    </body>
</html>
