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
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    // PER MONTH DATA
    const areaChartLabelMonthly = [];
    const dataSetMonthly = [];
    let monlyLabelData = {};
    let votesMonthCount = [];
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
        console.log('monlyLabelData', monlyLabelData)
        dataSetMonthly.push(monlyLabelData);
    @endforeach

    let areaChartData = {
        labels  : areaChartLabelMonthly,
        datasets: dataSetMonthly,
    }
    // END PER MONTH DATA

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
                }
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
    console.log('startDate', startDate.format('MM/DD/YYYY'))
    console.log('endDate', endDate.format('MM/DD/YYYY'))
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