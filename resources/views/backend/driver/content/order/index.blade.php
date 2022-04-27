@extends('backend.driver.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row align-items-center">
    <div class="col-md-12 col-12 mt-3">
      <table class="data-table table stripe hover nowrap">
        <thead>
          <tr>
            <th>Order Date</th>
            <th>Parcel Name</th>
            <th>Pick Up Location</th>
            <th>Delivery Location</th>
            <th>Delivery Scheduled</th>
            <th>Order Status Status</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $item)
            <tr>
              <td>{{ Carbon\Carbon::parse($item->order_details->pickup_details->created_at)->format('d M Y') }}</td>
              <td>
                {{ $item->order_details->pickup_details->parcel_name }}
              </td>
              <td>{{ $item->order_details->pickup_details->address }}</td>
              <td>{{ $item->order_details->delivery_details->address }}</td>
              <td>{{ $item->order_details->date }}</td>
              <td class="font-weight-bold">
                @if ($item->order_details->delivery_status->value == DeliveryStatus::Accepted->value)
                  Your order has been accepted.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Pick->value)
                  Your order is ready to be picked.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Arrived->value)
                  Driver has arrived your location to pick the order.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Picked->value)
                  Driver has picked your order.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Drop->value)
                  Your parcel is on the way to be dropped.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Dropped->value)
                  Driver has dropped your parcel.
                @elseif($item->order_details->delivery_status->value == DeliveryStatus::Delivered->value)
                  Your order has been delivered.
                @else
                  Your order is rejected.
                @endif
              </td>
              <td>
                @if ($item->order_details->delivery_status->value != DeliveryStatus::Delivered->value)
                  <a href="{{ route('driver.order.status', $item->order_id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="view-order"><i
                      class="icon-copy dw dw-search"></i></a>
                @else
                  <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Order has been delivered!"><i class="icon-copy dw dw-checked"></i></span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
