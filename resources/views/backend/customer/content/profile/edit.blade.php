@extends('backend.customer.layout.master')

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
            <form action="{{ route('customer.profile.update', $customer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">Name:</label>
                        <input type="text" name="customer_name" class="form-control" data-validation="required" value="{{ $customer->customer_name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email:</label>
                        <input type="email" name="email" class="form-control" data-validation="email" value="{{ $customer->email }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Phone:</label>
                        <input type="text" name="phone" class="form-control" data-validation="required" value="{{ $customer->phone }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Address:</label>
                        <textarea name="address" class="form-control" cols="30" rows="10" data-validation="required">{{ $customer->address }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Company Name:</label>
                        <input type="text" name="company_name" class="form-control" data-validation="required" value="{{ $customer->company_name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Company Registration:</label>
                        <input type="text" name="company_registration" class="form-control" data-validation="required" value="{{ $customer->company_registration }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Company Address:</label>
                        <textarea name="company_address" cols="30" rows="10" class="form-control" data-validation="required">{{ $customer->company_address }}</textarea>
                    </div>
                    <div class="form-group col-md-8 col-12">
                        <label for="">Profile Image:</label>
                        <input type="file" class="form-control" name="profile_image">
                    </div>
                    <div class="col-md-4 col-12 text-center">
                        <label for="">Current Image:</label> <br>
                        <img src="{{ Storage::url('customer_images/' . $customer->image) }}" class="img-fluid">
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
        $(document).ready(function() {
            $.validate();
        });
    </script>
@endpush
