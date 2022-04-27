@extends('backend.customer.layout.master')

@section('content')
  <div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 border-left">
      <div class="profile-info">
        <h5 class="mb-20 h5 text-blue">Pickup Details</h5>
        <ul>
          <li>
            <span>Location:</span>
            {{ $order->pickup_details->address }}
          </li>
          <li>
            <span>Name:</span>
            {{ $order->pickup_details->name }}
          </li>
          <li>
            <span>Phone:</span>
            {{ $order->pickup_details->phone }}
          </li>
          <li>
            <span>Email:</span>
            {{ $order->pickup_details->email }}
          </li>
          <li>
            <span>Parcel Name:</span>
            {{ $order->pickup_details->parcel_name }}
          </li>
          <li>
            <span>Weight:</span>
            {{ $order->pickup_details->weight }}
          </li>
          <li>
            <span>Description:</span>
            {{ $order->pickup_details->details }}
          </li>
          @if ($order->pickup_details->additional_note)
            <li>
              <span>Additional Pickup Notes:</span>
              {{ $order->pickup_details->additional_note }}
            </li>
          @endif

        </ul>
      </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 border-left">
      <div class="profile-info">
        <h5 class="mb-20 h5 text-blue">Delivery Details</h5>
        <ul>
          <li>
            <span>Location:</span>
            {{ $order->delivery_details->address }}
          </li>
          <li>
            <span>Name:</span>
            {{ $order->delivery_details->name }}
          </li>
          <li>
            <span>Phone:</span>
            {{ $order->delivery_details->phone }}
          </li>
          <li>
            <span>Email:</span>
            {{ $order->delivery_details->email }}
          </li>
          <li>
            <span>Details:</span>
            {{ $order->delivery_details->details }}
          </li>
        </ul>
      </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 border-left">
      <div class="profile-info">
        <h5 class="mb-20 h5 text-blue">Order Details</h5>
        <ul>
          <li>
            <span>Pickup Date:</span>
            {{ Carbon\Carbon::parse($order->date)->format('d M Y') }}
          </li>
          <li>
            <span>Preferrable Vehicle:</span>
            {{ $order->vehicle_type->name }}
          </li>
          <li>
            <span>Total:</span>
            {{ $order->price }}
          </li>
          <li>
            <span>Confirm Booking:</span>
            <a href="{{ route('customer.order.booking.result') }}" class="btn btn-success btn-md">Proceed To Pay</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
