
@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="css/test.css">
@endpush
@section('header')
    @parent
@endsection
@section('content')
    <div class="sect-cont">
        <div class="sect-rules">
            <p>South African Mobile Numbers have 11 digits with the area code 27 </p>
        </div>
        <div class="sect-test">
            <div class="sect-test-int">
                <form id="form" action="{{ url('/test') }}" method="post">
                    <label for="phone">Enter your phone number</label>
                    <input type="text" id="phone" name="phone" placeholder="phone" />
                    <input type="submit" id="submit" />
                </form>
                <div class="status-response">
                    <p class="correct"></p>
                    <p class="error"></p>
                    <p class="revision"></p>
                    <p class="number"></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
@endsection
@push('scripts')
    <script src="js/test.js"></script>
@endpush
