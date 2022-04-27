@extends('backend.customer.layout.master')

@section('content')
  <div class="row">
    <div class="col-md-4 col-12 align-items-center">
      <h5 class="text-info p-3"><u>Order Completion Report:</u></h5>
      <div id="chart8"></div>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('backend/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
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
@endpush
