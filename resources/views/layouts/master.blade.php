<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
</head>
<body>
    <div class="wrapper">
        <x-navbar />
        <x-sidebar />
        @yield('content')
        <x-footer />
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{url('js/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('js/adminlte.min.js')}}"></script>
</body>
</html>