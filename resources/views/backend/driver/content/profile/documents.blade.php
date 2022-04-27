@extends('backend.driver.layout.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
  @include('backend.partial.laravelError')
  <div class="row align-items-center">
    <div class="col-md-12 col-12">
      <form action="{{ route('driver.document.provide.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Document Name</th>
                  <th>Required Level</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($documents as $item)
                  <tr>
                    <td>{{ $item->document_name }}</td>
                    <td class="{{ $item->required_level->value == DriverDocumentLevel::High->value ? 'text-danger' : 'text-info' }}">{{ $item->required_level->value }}</td>
                    <td>
                      <input type="hidden" name="document_id[]" value="{{ $item->id }}">
                      <input type="file" name="files[]">
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success float-right">submit</button>
          </div>
        </div>
      </form>
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
