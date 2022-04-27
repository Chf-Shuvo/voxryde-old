@extends('backend.driver.layout.master')

@section('content')
  <div class="row">
    <div class="col-md-12 col-12">
      <table class="table table-striped table-responsive-sm">
        <tbody>
          <tr>
            <td class="font-weight-bold">Order Date:</td>
            <td>{{ $order->date }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Pickup Location:</td>
            <td>{{ $order->pickup_details->address }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Dropout Location:</td>
            <td>{{ $order->delivery_details->address }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Direction To Pickup Location:</td>
            <td>
              <a href="{{ route('driver.order.map', [$order->order_id, MapType::Pickup->value]) }}" class="btn btn-info btn-sm" target="_blank"><i class="icon-copy dw dw-pin"></i></a>
            </td>
          </tr>
          <tr>
            <td class="font-weight-bold">Directtion from Pickup to Delivery Location:</td>
            <td><a href="{{ route('driver.order.map', [$order->order_id, MapType::Delivery->value]) }}" class="btn btn-info btn-sm" target="_blank"><i class="icon-copy dw dw-pin"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
    {{-- Order Update Area --}}
    <div class="col-md-12 col-12 text-center">
      <h5>
        @if ($order->delivery_status->value == 'delivered')
          <span class="text-success">Order Complete</span>
        @else
          @if ($schedule_check)
            <span class="text-warning">Order Scheduled for Later</span>
          @else
            <span class="text-warning">
              @if ($order->delivery_status->value == DeliveryStatus::Accepted->value)
                Order has been accepted. <br>
                <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Pick->value]) }}" class="btn btn-warning btn-md m-3">On the way to pick the order</a>
              @elseif($order->delivery_status->value == DeliveryStatus::Pick->value)
                <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Arrived->value]) }}" class="btn btn-warning btn-md m-3">Arrived to pick the order</a>
              @elseif($order->delivery_status->value == DeliveryStatus::Arrived->value)
                <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Picked->value]) }}" class="btn btn-warning btn-md m-3">Order Picked</a>
              @elseif($order->delivery_status->value == DeliveryStatus::Picked->value)
                <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Drop->value]) }}" class="btn btn-warning btn-md m-3">On the way to drop</a>
              @elseif($order->delivery_status->value == DeliveryStatus::Drop->value)
                <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Dropped->value]) }}" class="btn btn-warning btn-md m-3">Order has been dropped</a>
              @elseif($order->delivery_status->value == DeliveryStatus::Dropped->value)
                <a href="#" class="btn btn-warning btn-md m-3" data-toggle="modal" data-target="#bd-example-modal-lg">
                  Deliver Order
                </a>
              @elseif($order->delivery_status->value == DeliveryStatus::Delivered->value)
                Order has been delivered.
              @else
                Your order is rejected.
              @endif
            </span>
          @endif
        @endif
      </h5>
    </div>
  </div>
  {{-- Delivery Order Modal --}}
  <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Order Delivery Confirmation:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-12">
              <form id="devlieryConfirmForm">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    {{ csrf_field() }}
                    <label for="">Delivery Confirmation:</label>
                    <select name="confirmation_method" class="form-control" required>
                      <option value="" selected disabled>choose a method....</option>
                      <option value="otp">OTP</option>
                      <option value="person">Deliver to a Different Person</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 d-none" id="confirm_field">
                    <label for="">Confiramtion Data:</label>
                    <input type="text" class="form-control" name="confirmation_data">
                    <small class="text-info">Put OTP or Person name here based on your Delivery Confirmation method.</small>
                    <br>
                    <small class="text-danger font-weight-bold d-none" id="errorMessage">Wrong OTP, try again!</small>
                  </div>
                  <div class="form-group col-md-12 d-none" id="submitField">
                    <button class="btn btn-success float-right" type="button" id="deliveryFormSubmit">submit</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-12 col-12 text-center d-none" id="deliverOrderField">
              <a href="{{ route('driver.order.status.update', [$order->id, DeliveryStatus::Delivered->value]) }}" class="btn btn-warning btn-md m-3" onclick="confirmPerson()">Deliver the order.</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      const deliveryMethod = $("select[name='confirmation_method']");
      deliveryMethod.on('change', function() {
        let method = deliveryMethod.find(":selected").val();
        if (method === 'otp') {
          $.ajax({
            type: "GET",
            url: "{{ route('otp.send') }}",
            data: {
              order_id: "{{ $order->order_id }}",
              type: "{{ OtpFor::Order->value }}"
            },
            success: function(data) {
              let confirmation_field = $("#confirm_field");
              confirmation_field.removeClass('d-none');
              confirmation_field.on('keyup', function() {
                $("#submitField").removeClass('d-none');
              });
            },
            error: function(data) {
              console.log('An error occurred.');
              console.log(data);
            },
          });
        } else {
          $("#confirm_field").removeClass('d-none');
          $("#submitField").removeClass('d-none');
        }
      });
      $("#deliveryFormSubmit").on('click', function() {
        const deliveryMethod = $("select[name='confirmation_method']").find(":selected").val();
        if (deliveryMethod === 'otp') {
          let otp = $("input[name='confirmation_data']").val();
          console.log(otp);
          $.ajax({
            type: "GET",
            url: "{{ route('otp.verify') }}",
            data: {
              order_id: "{{ $order->order_id }}",
              otp: otp
            },
            success: function(data) {
              console.log(data);
              if (data) {
                $("#deliverOrderField").removeClass('d-none');
                $("#submitField").addClass('d-none');
              } else {
                $("#errorMessage").removeClass('d-none');
              }
            },
            error: function(data) {
              console.log('An error occurred.');
              console.log(data);
            },
          });
        } else {
          $.ajax({
            type: "GET",
            url: "{{ route('driver.order.delivery.receiver') }}",
            data: {
              receiver: $("input[name='confirmation_data']").val(),
              order_id: "{{ $order->order_id }}"
            },
            success: function(data) {
              console.log(data);
              if (data) {
                $("#deliverOrderField").removeClass('d-none');
                $("#submitField").addClass('d-none');
              } else {
                alert('Receiver not updated, error!');
              }
            },
            error: function(data) {
              alert(data);
            },
          });
        }
      });
    });
  </script>
@endpush
