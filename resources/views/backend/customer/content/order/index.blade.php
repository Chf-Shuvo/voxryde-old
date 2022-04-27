@extends('backend.customer.layout.master')

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
            <th>Delivery Schedule</th>
            <th>Order Status Status</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $item)
            <tr>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
              <td>
                {{ $item->parcel_name }}
              </td>
              <td>{{ $item->address }}</td>
              <td>{{ $item->delivery_details->address }}</td>
              <td>{{ Carbon\Carbon::parse($item->order_details->date)->format('d M Y') }}</td>
              <td class="font-weight-bold">
                @if ($item->order_details->delivery_status->value == DeliveryStatus::Pending->value)
                  Your order is pending.
                @elseif ($item->order_details->delivery_status->value == DeliveryStatus::Accepted->value)
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
                @if ($item->order_details->delivery_status->value == DeliveryStatus::Reject->value)
                  <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Order has been rejected!"><i class="icon-copy dw dw-cancel"></i></span>
                @else
                  <a href="{{ route('customer.order.details.show', $item->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="track-order"><i
                      class="icon-copy dw dw-search"></i></a>
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
