@extends('backend.layout.master')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <a href="javascript:void(0)" class="btn btn-success btn-md float-right mr-3" data-toggle="modal" data-target="#userModal2"><i class="icon-copy dw dw-add"></i> Add Document</a>
      {{-- Document adding modal --}}
      <div class="modal fade" id="userModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="icon-copy dw dw-car"></i> Assign New Driver</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="{{ route('customer.document.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                  <div class="form-group col-md-12 col-12">
                    <label for="">Document Title:</label>
                    <input type="text" name="title" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="">Document:</label> <br>
                    <input type="file" name="document" class="form-control" data-validation="required">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="">Expiry Date:</label>
                    <input type="date" class="form-control" data-validation="required" name="expiry_date">
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
    <div class="col-lg-6 col-md-6 col-12">
      <h5 class="p-3">Customer Details:</h5>
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Customer Name:</td>
            <td>{{ $customer->customer_name }}</td>
          </tr>
          <tr>
            <td>Profile Image:</td>
            <td>image</td>
          </tr>
          <tr>
            <td>E-mail Address:</td>
            <td>{{ $customer->email }}</td>
          </tr>
          <tr>
            <td>Mobile Number:</td>
            <td>{{ $customer->phone }}</td>
          </tr>
          <tr>
            <td>Address:</td>
            <td>{{ $customer->address }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
      <h5 class="p-3">Company Details:</h5>
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Company Name:</td>
            <td>{{ $customer->company_name }}</td>
          </tr>
          <tr>
            <td>Company Registration Number:</td>
            <td>{{ $customer->company_registration }}</td>
          </tr>
          <tr>
            <td>Company Address:</td>
            <td>{{ $customer->company_address }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-12 col-md-12 col-12">
      <h5 class="p-3">Documents:</h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>View Document</th>
            <th>Expiry Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($documents as $item)
            <tr>
              <td>{{ $item->document_name }}</td>
              <td>
                <a href="{{ Storage::url('customer_documents/' . $item->document) }}" class="btn btn-success btn-sm" target="_blank">view-document</a>
              </td>
              <td>{{ Carbon\Carbon::parse($item->expiry_date)->format('d M Y') }}</td>
              <td>
                <a href="{{ route('customer.document.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove this item?')"><i
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
  <script>
    $(document).ready(function() {
      $.validate();
    });
  </script>
@endpush
