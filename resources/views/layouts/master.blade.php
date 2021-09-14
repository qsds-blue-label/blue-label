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
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="{{url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{url('plugins/toastr/toastr.min.css')}}">

    <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- <link rel="stylesheet" href="{{url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"> -->
     <style>
     /*!
 * Datepicker v1.0.10
 * https://fengyuanchen.github.io/datepicker
 *
 * Copyright 2014-present Chen Fengyuan
 * Released under the MIT license
 *
 * Date: 2020-09-29T14:46:09.037Z
 */

.datepicker-container {
  background-color: #fff;
  direction: ltr;
  font-size: 12px;
  left: 0;
  line-height: 30px;
  position: fixed;
  -webkit-tap-highlight-color: transparent;
  top: 0;
  -ms-touch-action: none;
  touch-action: none;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 210px;
  z-index: -1;
}

.datepicker-container::before,
.datepicker-container::after {
  border: 5px solid transparent;
  content: " ";
  display: block;
  height: 0;
  position: absolute;
  width: 0;
}

.datepicker-dropdown {
  border: 1px solid #ccc;
  -webkit-box-shadow: 0 3px 6px #ccc;
  box-shadow: 0 3px 6px #ccc;
  -webkit-box-sizing: content-box;
  box-sizing: content-box;
  position: absolute;
  z-index: 1;
}

.datepicker-inline {
  position: static;
}

.datepicker-top-left,
.datepicker-top-right {
  border-top-color: #39f;
}

.datepicker-top-left::before,
.datepicker-top-left::after,
.datepicker-top-right::before,
.datepicker-top-right::after {
  border-top: 0;
  left: 10px;
  top: -5px;
}

.datepicker-top-left::before,
.datepicker-top-right::before {
  border-bottom-color: #39f;
}

.datepicker-top-left::after,
.datepicker-top-right::after {
  border-bottom-color: #fff;
  top: -4px;
}

.datepicker-bottom-left,
.datepicker-bottom-right {
  border-bottom-color: #39f;
}

.datepicker-bottom-left::before,
.datepicker-bottom-left::after,
.datepicker-bottom-right::before,
.datepicker-bottom-right::after {
  border-bottom: 0;
  bottom: -5px;
  left: 10px;
}

.datepicker-bottom-left::before,
.datepicker-bottom-right::before {
  border-top-color: #39f;
}

.datepicker-bottom-left::after,
.datepicker-bottom-right::after {
  border-top-color: #fff;
  bottom: -4px;
}

.datepicker-top-right::before,
.datepicker-top-right::after,
.datepicker-bottom-right::before,
.datepicker-bottom-right::after {
  left: auto;
  right: 10px;
}

.datepicker-panel > ul {
  margin: 0;
  padding: 0;
  width: 102%;
}

.datepicker-panel > ul::before,
.datepicker-panel > ul::after {
  content: " ";
  display: table;
}

.datepicker-panel > ul::after {
  clear: both;
}

.datepicker-panel > ul > li {
  background-color: #fff;
  cursor: pointer;
  float: left;
  height: 30px;
  list-style: none;
  margin: 0;
  padding: 0;
  text-align: center;
  width: 30px;
}

.datepicker-panel > ul > li:hover {
  background-color: rgb(229, 242, 255);
}

.datepicker-panel > ul > li.muted,
.datepicker-panel > ul > li.muted:hover {
  color: #999;
}

.datepicker-panel > ul > li.highlighted {
  background-color: rgb(229, 242, 255);
}

.datepicker-panel > ul > li.highlighted:hover {
  background-color: rgb(204, 229, 255);
}

.datepicker-panel > ul > li.picked,
.datepicker-panel > ul > li.picked:hover {
  color: #39f;
}

.datepicker-panel > ul > li.disabled,
.datepicker-panel > ul > li.disabled:hover {
  background-color: #fff;
  color: #ccc;
  cursor: default;
}

.datepicker-panel > ul > li.disabled.highlighted,
.datepicker-panel > ul > li.disabled:hover.highlighted {
  background-color: rgb(229, 242, 255);
}

.datepicker-panel > ul > li[data-view="years prev"],
.datepicker-panel > ul > li[data-view="year prev"],
.datepicker-panel > ul > li[data-view="month prev"],
.datepicker-panel > ul > li[data-view="years next"],
.datepicker-panel > ul > li[data-view="year next"],
.datepicker-panel > ul > li[data-view="month next"],
.datepicker-panel > ul > li[data-view="next"] {
  font-size: 18px;
}

.datepicker-panel > ul > li[data-view="years current"],
.datepicker-panel > ul > li[data-view="year current"],
.datepicker-panel > ul > li[data-view="month current"] {
  width: 150px;
}

.datepicker-panel > ul[data-view="years"] > li,
.datepicker-panel > ul[data-view="months"] > li {
  height: 52.5px;
  line-height: 52.5px;
  width: 52.5px;
}

.datepicker-panel > ul[data-view="week"] > li,
.datepicker-panel > ul[data-view="week"] > li:hover {
  background-color: #fff;
  cursor: default;
}

.datepicker-hide {
  display: none;
}
     </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
    <!-- SweetAlert2 -->
    <script src="{{url('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{url('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{url('js/datepicker.js')}}"></script>


   
    <script>
  
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
        $(document).ready(function () {
           
            var clear_timer;
            $("#sample_form").on("submit", function (event) {
                $("#message").html("");
                event.preventDefault();
                $.ajax({
                    url: "import-file",
                    method: "post",
                    data: new FormData(this),
                    //dataType:"json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        // $("#import").attr("disabled", "disabled");
                        $("#import").val("Importing");
                    },
                    success: function (data) {  console.log('data', data)
                        toastr.success('Votes successfully imported.')
                        setTimeout(() => {
                           location.reload();
                        }, 2000);
                    },
                });
            });

            // function start_import() {
            //     $("#process").css("display", "block");
            //     $.ajax({
            //         url: "import.php",
            //         success: function () {},
            //     });
            // }
        });
    </script>

 <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        format: 'yyyy-mm-dd'
      });
    });
  </script>

</body>
</html>