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
        <link rel="stylesheet" href="{{url('css/calendar.css')}}">
        <!-- <link rel="stylesheet" href="{{url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"> -->
        <!-- DataTables -->
        <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <style>
            .btn-primary {
            color: #fff !important;
            background-color: #a99233 !important;
            border-color: #a99233 !important;
            box-shadow: none !important;
            }

            .btn-outline-primary {
                color: #a99233 !important;
                border-color: #a99233 !important;
                background-color: transparent !important;
            }
            .btn-outline-primary:hover{
                background-color: #a99233 !important;
                color: #fff !important;
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
        <!-- Datatables -->
        <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
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
        </script>    
       <?php if(Request::path() === 'import') { ?>
        <script src="{{url('js/import.js')}}"></script>
       <?php } ?>
       <?php if(Request::path() === 'voters') { ?>
        <script src="{{url('js/voters.js')}}"></script>
       <?php } ?>
       <?php if(Request::path() === 'votes') { ?>
        <script src="{{url('js/votes.js')}}"></script>
       <?php } ?>
        <!-- <script>
        $(function() {
            var oTable = $('#example2').DataTable({
                "bDestroy": true,
                "aaSorting": [],
                "ordering": false,
                "searching": true,
                "iDisplayLength": 20,
                "aLengthMenu": [
                    [20, 50, 100, 200, 500],
                    [20, 50, 100, 200, 500]
                ],
                /* "responsive": true,*/
                "processing": true,
                // "scrollX": true, // enables horizontal scrolling    
                /* "stateSave": true,*/ //restore table state on page reload, 
                "oLanguage": {
                    "sSearch": '<div class="input-group">_INPUT_<span class="input-group-addon"><i class="icon-search"></i></span></div>',
                    "sSearchPlaceholder": "Search...",
                   // "sProcessing": '' + image + '',
                },
                "serverSide": true,
                "ajax": {
                    url: "import-list",
                    type: 'POST',
                    dataFilter: function(data) { // console.log(data);
                        // var json = jQuery.parseJSON(data);
                        // json.recordsTotal = json.recordsFiltered;
                        // json.recordsFiltered = json.recordsFiltered;
                        // json.data = json.data;
                        // checkSummary(json.queryTotal);
                        // return JSON.stringify(json);
                    }


                }

            });
        });
           
        </script> -->
    </body>
</html>