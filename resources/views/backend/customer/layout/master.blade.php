<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/src/images/main-logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/src/images/main-logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/src/images/main-logo.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    @include('backend.customer.partial.css')
</head>

<body>
    {{-- Pre-Loader --}}
    {{-- @include('backend.partial.preLoader') --}}
    {{-- Pre-Loader Ends --}}

    {{-- navbar --}}
    @include('backend.customer.partial.navbar')
    {{-- navbar ends --}}

    {{-- Sidebar --}}
    @include('backend.customer.partial.sidebar')
    {{-- Sidebar ends --}}

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- js -->
    @include('backend.customer.partial.js')
</body>

</html>
