
@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="css/result.css">
@endpush
@section('header')
    @parent
@endsection
@section('content')
    <div class="sect-table">
        <x-table :dataTables='$v_data_page' />
    </div>
@endsection
@section('footer')
    @parent
@endsection
@push('scripts')
    <script src="js/result.js"></script>
@endpush
