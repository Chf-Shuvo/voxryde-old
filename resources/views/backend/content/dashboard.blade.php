@extends('backend.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-12">
            <h5 class="text-info p-3"><u>Customer and Driver Summary Report:</u></h5>
            <div id="chart3"></div>
        </div>
        <div class="col-md-4 col-12">
            <h5 class="text-info p-3"><u>Order Completion Report ({{ date('M, Y') }}):</u></h5>
            <div id="chart8"></div>
        </div>
        <div class="col-md-12 col-12">
            <h5 class="text-info p-3"><u>Collections:</u></h5>
            <div id="chart10"></div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var options3 = {
            series: [{
                name: 'Customer Joined',
                data: {{ json_encode($customer_joined) }}
            }, {
                name: 'Driver Joined',
                data: {{ json_encode($drivers_joined) }}
            }, {
                name: 'Customer Left',
                data: {{ json_encode($customer_removed) }}
            }, {
                name: 'Driver Left',
                data: {{ json_encode($drivers_removed) }}
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: 'Single Unit'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart3"), options3);
        chart.render();
    </script>
    <script>
        var options8 = {
            series: {{ json_encode($order_summary) }},
            chart: {
                type: 'donut',
            },
            labels: ['Delivered', 'Pending', 'Rejected'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#chart8"), options8);
        chart.render();
    </script>
    <script>
        var options = {
            series: [{
                name: 'Amount',
                data: {{ json_encode($collection_summary) }}
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: 'In Currency: '
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart10"), options);
        chart.render();
    </script>
@endpush
