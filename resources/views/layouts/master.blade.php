@php
    if(!Session::get('user')){
        redirect()->to('/login')->send();
    }
@endphp

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
        <!-- Date -->
        <script src="{{url('js/datepicker.js')}}"></script>
        <script src="{{url('js/moment.min.js')}}"></script>
        <script src="{{url('js/daterangepicker.js')}}"></script>
        <!-- Chart -->
        <script src="{{url('js/Chart.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script> 
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

       @if(Request::path() === '/')
        <script>
            $(document).ready(function () {
                let donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                const donutlabels = [];
                const donutCount = [];
                @foreach($overall as $all)
                    donutlabels.push('{{ $all->cadidate_code }}');
                    donutCount.push('{{ $all->totalCount }}');
                @endforeach
                
                let donutData = {
                    labels: donutlabels,
                    datasets: [
                    {
                        data: donutCount,
                        backgroundColor : ['#FFC0CB', '#00a65a', '#654321'],
                    }
                    ]
                }
                let donutOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += Number(data);
                            });
                            let percentage = (value*100 / sum).toFixed(2)+"%";
                            return percentage;                
                        },
                            color: '#000',
                        }
                    }
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                // PER MONTH DATA
                let areaChartLabelMonthly = [];
                let dataSetMonthly = [];
                let monlyLabelData = {};
                let votesMonthCount = [];

                @if(count($monthly['monthlist']) > 0)
                    @foreach($monthly['monthlist'] as $monthName)
                        areaChartLabelMonthly.push('{{ $monthName }}');
                    @endforeach

                    @foreach($monthly['votes'] as $key => $voteMonth)
                        monlyLabelData = {};
                        monlyLabelData = {
                            label               : '{{ $key }}',
                            backgroundColor     : getColor('{{ $key }}'),
                        }
                        @foreach($voteMonth as $voteCount)
                            votesMonthCount.push({{$voteCount}});
                        @endforeach
                        monlyLabelData.data = votesMonthCount;
                        votesMonthCount = [];
                        dataSetMonthly.push(monlyLabelData);
                    @endforeach

                @else
                    areaChartLabelMonthly = ['N/A', 'N/A'];
                    dataSetMonthly = [
                        {
                            label: 'N/A',
                            backgroundColor: '#fff',
                            data: [0, 0]
                        },
                        {
                            label: 'N/A',
                            backgroundColor: '#fff',
                            data: [0, 0]
                        }
                    ];
                @endif

                let areaChartData = {
                    labels  : areaChartLabelMonthly,
                    datasets: dataSetMonthly,
                }
                // END PER MONTH DATA

                // return;

                // PER BARANGAY DATA
                const areaChartLabelBarangay = [];
                const dataSetBarangay = [];
                let barangayLabelData = {};
                let votesBarangayCount = [];

                @foreach($barangay['barangayList'] as $brgyName)
                    areaChartLabelBarangay.push('{{ $brgyName }}');
                @endforeach

                @foreach($barangay['votes'] as $key => $voteBarangay)
                    barangayLabelData = {};
                    barangayLabelData = {
                        label               : '{{ $key }}',
                        backgroundColor     : getColor('{{ $key }}'),
                    }
                    @foreach($voteBarangay as $voteCount)
                        votesBarangayCount.push({{$voteCount}});
                    @endforeach
                    barangayLabelData.data = votesBarangayCount;
                    votesBarangayCount = [];
                    dataSetBarangay.push(barangayLabelData);
                @endforeach

                let perBarangay = {
                    labels  : areaChartLabelBarangay,
                    datasets: dataSetBarangay
                }

                // END PER BARANGAY DATA

                // START PER MUNICIPALITY DATA
                const barChartLabelMunicipality = [];
                const dataSetMunicipality = [];
                let municipalityLabelData = {};
                let votesMunicipalityCount = [];

                @foreach($municipality['municipalityList'] as $muniName)
                    barChartLabelMunicipality.push('{{ $muniName }}');
                @endforeach

                @foreach($municipality['votes'] as $key => $voteMunicipality)
                    municipalityLabelData = {};
                    municipalityLabelData = {
                        label               : '{{ $key }}',
                        backgroundColor     : getColor('{{ $key }}'),
                    }
                    @foreach($voteMunicipality as $voteCount)
                        votesMunicipalityCount.push({{$voteCount}});
                    @endforeach
                    municipalityLabelData.data = votesMunicipalityCount;
                    votesMunicipalityCount = [];
                    dataSetMunicipality.push(municipalityLabelData);
                @endforeach

                let perMuni = {
                labels  : barChartLabelMunicipality,
                datasets: dataSetMunicipality
                }

                // END PER MUNICIPALITY DATA

                //-------------
                //- BAR CHART MONTHLY-
                //-------------
                let barChartCanvas = $('#barChart').get(0).getContext('2d')
                let barChartData = $.extend(true, {}, areaChartData)
                let temp0 = areaChartData.datasets[0]
                let temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                let barChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false,
                    scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            },
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                //---------------------
                //- BAR CHART BARANGAY -
                //---------------------
                let stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                let stackedBarChartData = $.extend(true, {}, perBarangay)

                let stackedBarChartOptions = {
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
                
                let stackedBarChartCanvas1 = $('#data-muni').get(0).getContext('2d')
                let stackedBarChartData1 = $.extend(true, {}, perMuni)

                let stackedBarChartOptions1 = {
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

            $('#daterange-btn').on('apply.daterangepicker', function(ev, {startDate, endDate}) {
                // console.log('startDate', startDate.format('YYYY-MM-DD'))
                // console.log('endDate', endDate.format('YYYY-MM-DD'))
                window.location = '?start=' + startDate.format('YYYY-MM-DD') + '&endDate=' + endDate.format('YYYY-MM-DD');

            });


            function getColor(code) {
                switch (code) {
                    case 'JTU':
                        return '#FFC0CB';
                        break;
                    case 'OSM':
                        return '#00a65a';
                        break;
                    case 'PMU':
                        return '#654321';
                        break;
                    default:
                        return '#343a40';
                }
            }

        </script>
        @endif
    </body>
</html>