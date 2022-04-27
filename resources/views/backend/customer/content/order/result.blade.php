@extends('backend.customer.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 text-center">
            <img src="{{ Storage::url('/order_images/ok.png') }}" height="150" width="150">
            <h4 class="text-info">Congratulations! Your booking is successful.</h4>
        </div>
        <div class="col-md-12 col-12">
            <h6 class="mt-3 text-warning text-center">You can track your order status from <a href="{{ route('customer.order.all') }}" class="text-blue">all-orders</a> section.
                You will get notified
                each time your order status is updated. Thank you for
                choosing
                VOX,
                your reliable courier service.</h6>
        </div>
    </div>
@endsection
