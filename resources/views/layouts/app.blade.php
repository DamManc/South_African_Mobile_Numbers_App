<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <title>SAMNA</title>
    <!-- Fonts -->
    <!-- Styles -->
    @stack('styles')
</head>
<body>
@section('header')
    @include('layouts.common.header')
@show
<main class="content">
    @yield('content')
</main>
@section('footer')
    @include('layouts.common.footer')
@show

@stack('scripts')
</body>
</html>
