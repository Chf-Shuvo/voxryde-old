@extends('backend.layout.master')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css">
@endpush

@section('content')
    <div class="row align-items-center">
        <div class="col-md-12 mt-3">
            <form action="{{ route('vehicle-types.update',$vehicleType->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Vehicle Type:</label>
                        <input type="text" name="name" class="form-control" data-validation="required" value="{{ $vehicleType->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Icon:</label>
                        <input type="file" name="icon" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Selected Icon:</label>
                        <input type="file" name="selected_icon" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success btn-md float-right">update</button>
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