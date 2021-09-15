<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="{{ url('favicon.ico') }}">
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
        <script src="{{url('js/Chart.min.js')}}"></script>
        <!-- Datatables -->
        <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script>
            $(function () {
              $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            });
        </script>
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
            $(document).on('change', 'input[type="file"]', function (event) { 
                var filename = $(this).val();
                if (filename == undefined || filename == ""){
                $(this).next('.custom-file-label').html('No file chosen');
                }
                else 
                { $(this).next('.custom-file-label').html(event.target.files[0].name); }
            });
        </script>

        <script>
            $(function () {
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData        = {
                    labels: [
                        'JTU',
                        'OSM',
                        'PMU'
                    ],
                    datasets: [
                    {
                        data: [700,900,300],
                        backgroundColor : ['#FFC0CB', '#00a65a', '#654321'],
                    }
                    ]
                }
                var donutOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                var areaChartData = {
                labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                    label               : 'JTU',
                    backgroundColor     : '#FFC0CB',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                    label               : 'OSM',
                    backgroundColor     : '#00a65a',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                    label               : 'PMU',
                    backgroundColor     : '#654321',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [60, 50, 73, 90, 50, 55, 55]
                    },
                ]
                }
                var perBarangay = {
                labels  : ['Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5', 'Barangay 6', 'Barangay 7'],
                datasets: [
                    {
                    label               : 'JTU',
                    backgroundColor     : '#FFC0CB',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                    label               : 'OSM',
                    backgroundColor     : '#00a65a',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                    label               : 'PMU',
                    backgroundColor     : '#654321',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [60, 50, 73, 90, 50, 55, 55]
                    },
                ]
                }
                var perMuni = {
                labels  : ['Municipality 1', 'Municipality 2', 'Municipality 3', 'Municipality 4', 'Municipality 5', 'Municipality 6', 'Municipality 7'],
                datasets: [
                    {
                    label               : 'JTU',
                    backgroundColor     : '#FFC0CB',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [120, 150, 90, 80, 100, 70, 50]
                    },
                    {
                    label               : 'OSM',
                    backgroundColor     : '#00a65a',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [150, 100, 150, 170, 200, 160, 110]
                    },
                    {
                    label               : 'PMU',
                    backgroundColor     : '#654321',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [100, 120, 110, 150, 80, 140, 130]
                    },
                ]
                }

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                //---------------------
                //- STACKED BAR CHART -
                //---------------------
                var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                var stackedBarChartData = $.extend(true, {}, perBarangay)

                var stackedBarChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    scales: {
                        xAxes: [{
                        stacked: true,
                        }],
                        yAxes: [{
                        stacked: true
                        }]
                    }
                }
                new Chart(stackedBarChartCanvas, {
                    type: 'bar',
                    data: stackedBarChartData,
                    options: stackedBarChartOptions
                })
                
                var stackedBarChartCanvas1 = $('#data-muni').get(0).getContext('2d')
                var stackedBarChartData1 = $.extend(true, {}, perMuni)

                var stackedBarChartOptions1 = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    scales: {
                        xAxes: [{
                        stacked: true,
                        }],
                        yAxes: [{
                        stacked: true
                        }]
                    }
                }
                new Chart(stackedBarChartCanvas1, {
                    type: 'bar',
                    data: stackedBarChartData1,
                    options: stackedBarChartOptions1
                })


                $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
                )

            });

        </script>
    </body>
</html>