@extends('backend.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row align-items-center">
    <div class="col-md-12 mt-3">
      <form action="{{ route('price.update', $price->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">Vehicle Type:</label>
            <select name="vehicle_type" class="form-control" data-validation="required">
              @foreach ($vehicleTypes as $item)
                <option value="{{ $item->id }}" @if ($item->id == $price->getRawOriginal('vehicle_type')) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="">Service Charge:</label>
            <input type="text" name="servic_charge" class="form-control" data-validation="number" data-validation-allowing="float" value="{{ $price->service_charge }}">
          </div>
          <div class="form-group col-md-6">
            <label for="">Price Per KM:</label>
            <input type="text" name="price_per_km" class="form-control" data-validation="number" data-validation-allowing="float" value="{{ $price->price_per_km }}">
          </div>
          <div class="form-group col-md-6">
            <label for="">Range in KM:</label>
            <input type="text" name="range_km" class="form-control" data-validation="number" data-validation-allowing="float" value="{{ $price->range_km }}">
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success btn-md float-right">submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/scripts/datatable-setting.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
  <script>
    $(document).ready(function() {
      $.validate();
      // password check
      $("input[name='confirmPassword']").keyup(function(e) {
        var password = $("input[name='password']").val();
        var passwordConfirm = $("input[name='confirmPassword']").val();
        if (password == passwordConfirm) {
          $("#confirmationMessage").html('<span class="text-success">Password matched</span>');
        } else {
          $("#confirmationMessage").html('<span class="text-danger">Password did not match</span>');
        }
      });
    });
  </script>
@endpush
