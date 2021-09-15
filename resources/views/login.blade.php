<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Log in</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            .btn-primary {
            color: #fff !important;
            background-color: #a99233 !important;
            border-color: #a99233 !important;
            box-shadow: none !important;
            }
        </style>
    </head>
    <body class="hold-transition login-page" style="background: #343a3f !important;" >
        <div class="login-box" >
            <div class="login-logo">
                <img src="{{ url('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 131px">
                <h3 style="color: #b19a2e;margin-top: 10px">Blue Label</h3>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                   <p class="login-box-msg">Sign in to start your session</p>
                    <div id="messages" style="display: none">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Erro Found!</h5>
                            User credentials are incorrect. Please try again.
                        </div>
                    </div>
                    <form id="login-form" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="{{url('js/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{url('js/adminlte.min.js')}}"></script>
        <script>
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
               $(document).ready(function () {
                   $("#login-form").on("submit", function (event) {
                       //$("#message").html("");
                       event.preventDefault();
                       $.ajax({
                           url: "check-login",
                           method: "post",
                           data: $(this).serialize(),
                           dataType:"json",
                           beforeSend: function () {
                              
                           },
                           success: function (data) {  
                               if(data?.role === 1){
                                   window.location.href = '/'
                               }
                               //toastr.success('Votes successfully imported.')
                           },
                           error: function (data) {  
                              $("#messages").show();
                           }
                       });
                   });
               });
        </script>
    </body>
</html>