@extends('backend.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  @include('backend.partial.laravelError')
  <div class="row align-items-center">
    <div class="col-md-12">
      <a href="javascript:void(0)" class="btn btn-info btn-md float-right" data-toggle="modal" data-target="#userModal"><i class="icon-copy dw dw-add"></i> add new</a>

      <!-- Modal -->
      <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="icon-copy dw dw-money"></i> Add New Pricing</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="{{ route('price.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="">Vehicle Type:</label>
                    <select name="vehicle_type" class="form-control" data-validation="required">
                      @foreach ($vehicleTypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">Service Charge:</label>
                    <input type="text" name="service_charge" class="form-control" data-validation="number" data-validation-allowing="float">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">Price Per KM:</label>
                    <input type="text" name="price_per_km" class="form-control" data-validation="number" data-validation-allowing="float">
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success btn-md float-right">submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-3">
      <table class="data-table table stripe hover nowrap">
        <thead>
          <tr>
            <th>Vehicle Type</th>
            <th>Service Charge</th>
            <th>Price Per KM</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pricings as $item)
            <tr>
              <td>{{ $item->vehicle_type }}</td>
              <td>{{ $item->service_charge }}</td>
              <td>{{ $item->price_per_km }}</td>
              <td>
                <a href="{{ route('price.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="icon-copy dw dw-edit2"></i></a>

                <a href="{{ route('price.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove this item?')"><i
                    class="icon-copy dw dw-delete-3"></i></a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
  <script>
    $(document).ready(function() {
      $.validate();
    });
  </script>
@endpush
