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
              <h4 class="modal-title"><i class="icon-copy dw dw-user"></i> Add New Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="">Name:</label>
                    <input type="text" name="customer_name" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" data-validation="email">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">Phone:</label>
                    <input type="text" name="phone" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Address:</label>
                    <textarea name="address" class="form-control" cols="30" rows="10" data-validation="required"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Company Name:</label>
                    <input type="text" name="company_name" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Company Registration:</label>
                    <input type="text" name="company_registration" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Company Address:</label>
                    <textarea name="company_address" cols="30" rows="10" class="form-control" data-validation="required"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Status:</label>
                    <select name="status" class="form-control">
                      <option value="0">inactive</option>
                      <option value="1">active</option>
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
    <div class="col-md-12 mt-3">
      <table class="data-table table stripe hover nowrap">
        <thead>
          <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Number</th>
            <th>Date Time</th>
            <th>Account Status</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->customer_name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
              <td>{{ $item->status->value }}</td>
              <td>
                {{-- password reset --}}
                <a href="{{ route('customer.reset.password', $item->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="reset customer's account password"
                  onclick="return confirm('Are you sure to reset this customer password?')"><i class="icon-copy dw dw-password"></i></a>
                {{-- approve or block account --}}
                <a href="{{ route('customer.status', $item->id) }}" class="btn {{ $item->status->value == 'active' ? 'btn-danger' : 'btn-info' }} btn-sm" data-toggle="tooltip" data-placement="top"
                  title="approve/block customer's account">
                  @if ($item->status->value == 'active')
                    <i class="icon-copy dw dw-cancel"></i>
                  @else
                    <i class="icon-copy dw dw-check"></i>
                  @endif
                </a>

                <a href="{{ route('customer.show', $item->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="view customer details"><i
                    class="icon-copy dw dw-eye"></i></a>

                <a href="{{ route('customer.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="icon-copy dw dw-edit2"></i></a>

                <a href="{{ route('customer.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                  onclick="return confirm('This customer will be deleted along with all the information that is related. Including orders, previous delivers, upcoming deliveries, etc. Make sure you have backed up all those informations!')"><i
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
