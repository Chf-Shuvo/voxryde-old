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
              <form action="{{ route('driver.document.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">Document Name:</label>
                    <input type="text" name="document_name" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Document Require Level:</label>
                    <select name="required_level" class="form-control">
                      <option value="{{ DriverDocumentLevel::High->value }}">{{ DriverDocumentLevel::High->value }}</option>
                      <option value="{{ DriverDocumentLevel::Optional->value }}">{{ DriverDocumentLevel::Optional->value }}</option>
                    </select>
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

            <th class="datatable-nosort">Document Name</th>
            <th class="datatable-nosort">Required Level</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($documents as $item)
            <tr>
              <td>{{ $item->document_name }}</td>
              <td>{{ $item->required_level->value }}</td>
              <td>
                <a href="{{ route('driver.document.destroy', $item->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="delete-document"
                  onclick="return confirm('Are you sure to remove this item?')"><i class="icon-copy dw dw-delete-3"></i></a>
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
