@extends('backend.layout.master')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
    <div class="row align-items-center">
        <div class="col-md-12 mt-3">
          <form action="{{ route('driver-details.update', $driver->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method("PATCH")
              <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="">Driver Name:</label>
                    <input type="text" name="name" class="form-control" data-validation="required" value="{{ $driver->name }}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="">Driver Email:</label>
                    <input type="email" name="email" class="form-control" data-validation="email" value="{{ $driver->email }}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="">Driver Contact:</label>
                    <input type="text" name="contact" class="form-control" data-validation="number" value="{{ $driver->contact }}">
                  </div>
                  <div class="form-group col-md-3 col-3">
                    <label for="">Driver Image:</label>
                    <input type="file" class="form-control" name="image">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">Vehicle Type:</label>
                    <select name="vehicle_type" class="form-control" data-validation="required">
                        @foreach ($vehicleTypes as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="">Vehicle Name:</label>
                      <input type="text" name="vehicle_name" class="form-control" data-validation="required" value="{{ $driver->vehicle_name }}">
                  </div>
                  <div class="form-group col-md-4">
                      <label for="">Vehicle Color:</label>
                      <input type="text" name="vehicle_color" class="form-control" data-validation="required" value="{{ $driver->vehicle_color}}">
                  </div>
                  <div class="form-group col-md-12">
                    <div class="custom-control custom-checkbox mb-5">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="password">
                      <label class="custom-control-label" for="customCheck1">Reset Password to Default(123456):</label>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
    <script>
        $(document).ready(function () {
            $.validate();
        });
    </script>
@endpush