@extends('backend.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row align-items-center">
    <div class="col-md-12">
      <a href="javascript:void(0)" class="btn btn-info btn-md float-right" data-toggle="modal" data-target="#userModal"><i class="icon-copy dw dw-add"></i> add new</a>

      <!-- Modal -->
      <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="icon-copy dw dw-delivery-truck"></i> Add New Driver</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="{{ route('driver-details.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">Driver Name:</label>
                    <input type="text" name="name" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Driver Email:</label>
                    <input type="email" name="email" class="form-control" data-validation="email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Driver Contact:</label>
                    <input type="text" name="contact" class="form-control" data-validation="number">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="">Profile Image:</label>
                    <input type="file" class="form-control" name="image">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Vehicle Type:</label>
                    <select name="vehicle_type" class="form-control" data-validation="required">
                      @foreach ($vehicleTypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Vehicle Name:</label>
                    <input type="text" name="vehicle_name" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Vehicle Color:</label>
                    <input type="text" name="vehicle_color" class="form-control" data-validation="required">
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
    @include('backend.partial.laravelError')
    <div class="col-md-12 mt-3">
      <table class="data-table table stripe hover nowrap">
        <thead>
          <tr>
            <th class="table-plus datatable-nosort">Driver ID</th>
            <th>Driver Name</th>
            <th class="datatable-nosort">Driver Email</th>
            <th class="datatable-nosort">Contact Number</th>
            <th class="datatable-nosort">Image</th>
            <th class="datatable-nosort">Date Time</th>
            <th>Account Status</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($drivers as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->contact }}</td>
              <td>
                <img src="{{ Storage::url('driver_images/' . $item->image) }}" alt="">
              </td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
              <td>{{ $item->status->value }}</td>
              <td>
                {{-- reset password --}}
                <a href="{{ route('driver.reset.password', $item->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="reset driver's account password"
                  onclick="return confirm('Are you sure to reset this customer password?')"><i class="icon-copy dw dw-password"></i></a>
                {{-- approve or block account --}}
                <a href="{{ route('driver-details.status', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="approve/block driver's account">
                  @if ($item->getRawOriginal('status') == 1)
                    <i class="icon-copy dw dw-cancel"></i>
                  @else
                    <i class="icon-copy dw dw-check"></i>
                  @endif
                </a>
                {{-- edit driver --}}
                <a href="{{ route('driver-details.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="icon-copy dw dw-edit2"></i></a>
                {{-- delete driver --}}
                <a href="{{ route('driver-details.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove this item?')"><i
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
