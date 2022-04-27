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
                            <h4 class="modal-title"><i class="icon-copy dw dw-car"></i> Add New Vehicle Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('vehicle-types.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="">Vehicle Type:</label>
                                      <input type="text" name="name" class="form-control" data-validation="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="">Icon:</label>
                                      <input type="file" name="icon" class="form-control" data-validation="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="">Selected Icon:</label>
                                      <input type="file" name="selected_icon" class="form-control" data-validation="required">
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
        <div class="col-md-12 col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12 mt-3">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="datatable-nosort">Vehicle ID</th>
                        <th>Name</th>
                        <th class="datatable-nosort">Icon</th>
                        <th class="datatable-nosort">Selected Icon</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicleTypes as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                          <img src="{{ Storage::url('vehicle_icons/'.$item->icon) }}" alt="no-icon" height="50" width="50">
                        </td>
                        <td>
                          <img src="{{ Storage::url('vehicle_icons/'.$item->selected_icon) }}" alt="no-icon" height="50" width="50">
                        </td>
                        <td>
                          <a href="{{ route('vehicle-types.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="icon-copy dw dw-edit2"></i></a>

                          <a href="{{ route('vehicle-types.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove this item?')"><i class="icon-copy dw dw-delete-3"></i></a>
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
        $(document).ready(function () {
            $.validate();
        });
    </script>
@endpush