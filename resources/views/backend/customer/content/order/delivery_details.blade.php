@extends('backend.customer.layout.master')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <form action="{{ route('customer.order.details') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <input type="hidden" name="order_id" value="{{ $order->id }}">
          <div class="form-group col-md-6 col-12">
            <label for="">Deliver Address:<span class="text-danger">*</span></label>
            <input type="text" name="address" class="form-control" id="searchTextField" data-validation="required">
          </div>
          <div class="form-group col-md-6 col-12">
            <label for="">Name:<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" data-validation="required">
            <input type="hidden" name="map_lat" id="map_lat">
            <input type="hidden" name="map_long" id="map_long">
          </div>
          <div class="form-group col-md-6 col-12">
            <label for="">Phone:<span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" data-validation="number">
          </div>
          <div class="form-group col-md-6 col-12">
            <label for="">Email:<span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group col-md-12 col-12">
            <label for="">Details:<span class="text-danger">*</span></label>
            <textarea name="details" class="form-control" data-validation="required"></textarea>
          </div>
          <div class="form-group col-md-12 col-12">
            <button type="submit" class="btn btn-success float-right">next</button>
          </div>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-KnRoUdTT4_xQ_xbyVkvXPoKUNTZptnE&libraries=places&callback=initMap" async defer></script>
  <script>
    $(document).ready(function() {
      $.validate();
    });
  </script>
  <script>
    function initMap() {
      var input = document.getElementById("searchTextField");
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.setFields([
        "address_components",
        "place_id",
        "geometry",
        "name",
        "icon",
      ]);
      autocomplete.setComponentRestrictions({
        country: ["bd"],
      });
      autocomplete.addListener("place_changed", function() {
        var place = autocomplete.getPlace();
        // $("#searchTextField").val(place.name);
        $("#map_lat").val(place.geometry.location.lat());
        $("#map_long").val(place.geometry.location.lng());
      });
    }
  </script>
@endpush
