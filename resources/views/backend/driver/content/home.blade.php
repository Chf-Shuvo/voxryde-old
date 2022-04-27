@extends('backend.driver.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
@endpush

@section('content')
  <div class="row">
    @if ($open_orders->isNotEmpty())
      <div class="col-md-12 col-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Parcel Name</th>
              <th>Pickup Address</th>
              <th>Delivery Address</th>
              <th>Distance</th>
              <th>Approximate Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($open_orders as $item)
              <tr>
                <td>{{ $item->pickup_details->parcel_name }}</td>
                <td>{{ $item->pickup_details->address }}</td>
                <td>{{ $item->delivery_details->address }}</td>
                <td>{{ $item->distance_from_me->distance_km }}</td>
                <td>{{ $item->distance_from_me->time }}</td>
                <td>
                  <a href="{{ route('driver.order.handle', [$item->id, DeliveryStatus::Accepted->value]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                    title="accept-order"><i class="icon-copy dw dw-checked"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection


@push('js')
  <script src="{{ asset('backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
