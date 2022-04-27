@extends('backend.customer.layout.master')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <form action="{{ route('customer.order.confirm') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <input type="hidden" name="order_id" value="{{ $deliver_details->order_id }}">
          <div class="form-group col-md-6 col-12">
            <label for="">Schedule Order: <span class="text-danger">*</span></label>
            <input type="text" name="date" class="form-control date-picker" data-validation="required" value="{{ Carbon\Carbon::now()->format('d M Y') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="">Distance:<span class="text-danger">*</span></label>
            <input type="text" name="distance" class="form-control" id="distance" readonly>
            <small class="text-info">distance in km</small>
          </div>
          <div class="form-group col-md-6 col-12">
            <label for="">Payment Type:<span class="text-danger">*</span></label>
            <select name="payment_type" class="form-control selectpicker">
              <option value="cash">Cash</option>
              <option value="online">Pay Online</option>
            </select>
          </div>
          <div class="form-group col-md-6 col-12">
            <label for="">Choose Vehicle Type:<span class="text-danger">*</span></label>
            <select name="preferred_vehicle" class="form-control selectpicker">
              @foreach ($vehicle_types as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-12 col-12">
            <button type="submit" class="btn btn-success float-right">Confirm Booking</button>
          </div>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-KnRoUdTT4_xQ_xbyVkvXPoKUNTZptnE&callback=initMap&v=weekly&channel=2" async></script>
  <script>
    $(document).ready(function() {
      $.validate();
    });
  </script>
  <script>
    function initMap() {
      const service = new google.maps.DistanceMatrixService();
      // build request
      const origin = "{{ $deliver_details->pickup_details->address }}";
      const destination = "{{ $deliver_details->address }}";
      const request = {
        origins: [origin],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false,
      };
      service.getDistanceMatrix(request).then((response) => {
        let distance = Math.ceil(response.rows[0].elements[0].distance.value / 1000);
        $("#distance").val(distance);
      });
    }
  </script>
@endpush
