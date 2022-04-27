@extends('backend.customer.layout.master')

@section('content')
  <div class="row">
    <div class="col-md-12 col-12">
      <div class="timeline mb-30">
        <ul>
          {{-- initial message while driver not yet accepted the order --}}
          <li>
            <div class="timeline-date">
              {{ Carbon\Carbon::parse($order->order_details->created_at)->format('d M Y') }}
            </div>
            <div class="timeline-desc alert alert-warning">
              <div class="pd-5">
                <h6 class="mb-10">Waiting for acceptance.</h6>
                <span>@ {{ Carbon\Carbon::parse($order->order_details->created_at)->format('h:i a') }}</span>
              </div>
            </div>
          </li>
          {{-- each status update --}}
          @foreach ($order->timeline as $item)
            <li>
              <div class="timeline-date">
                {{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
              </div>
              <div class="timeline-desc alert {{ $item->delivery_status->value != DeliveryStatus::Reject->value ? 'alert-success' : 'alert-danger' }}">
                <div class="pd-5">
                  <h6 class="mb-10">
                    @if ($item->delivery_status->value == DeliveryStatus::Accepted->value)
                      {{ $order->driver->name }} has accepted your order.
                    @elseif($item->delivery_status->value == DeliveryStatus::Pick->value)
                      {{ $order->driver->name }} is ready to pick your order.
                    @elseif($item->delivery_status->value == DeliveryStatus::Arrived->value)
                      {{ $order->driver->name }} has arrived your location to pick the order.
                    @elseif($item->delivery_status->value == DeliveryStatus::Picked->value)
                      {{ $order->driver->name }} has picked your order.
                    @elseif($item->delivery_status->value == DeliveryStatus::Drop->value)
                      {{ $order->driver->name }} is on the way to drop your order.
                    @elseif($item->delivery_status->value == DeliveryStatus::Dropped->value)
                      {{ $order->driver->name }} has dropped your parcel.
                    @elseif($item->delivery_status->value == DeliveryStatus::Delivered->value)
                      Your order has been delivered.
                    @else
                      Your order is rejected.
                    @endif
                  </h6>
                  <span>@ {{ Carbon\Carbon::parse($item->created_at)->format('h:i a') }}</span>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
