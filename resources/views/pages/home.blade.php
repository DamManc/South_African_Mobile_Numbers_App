@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="css/home.css">
@endpush
@section('header')
@parent
@endsection
@section('content')
<div class="sect-form">
    <div class="status-session">
        <p></p>
    </div>
    <form id="form" method="POST" enctype="multipart/form-data">
        <div class="sect-form-int">
            <label for="file">Upload a csv file:</label>
            <input class="upload_btn" type='file' name="file" accept=".csv" />
            <div class="delete_btn">Delete</div>
            <input type="submit" id="submit" />
            <a href="{{ url('result') }}">
                <button type="button" class="result">Result in HTML</button>
            </a>
        </div>
    </form>
</div>
<div class="sect-result">
    <a href="/downloadacc">
        <button type="button" class="download_btn_acc">Download the result Correct</button>
    </a>
    <a href="/downloadrev">
        <button type="button" class="download_btn_rev">Download the Revision</button>
    </a>
    <a href="/downloadinc">
        <button type="button" class="download_btn_inc">Download the Incorrect</button>
    </a>
    <a href="/apiendpoint">
        <button class="apiEnd">
            <p>{{url('apiendpoint')}}</p>
        </button>
    </a>
</div>
@endsection
@section('footer')
@parent
@endsection
@push('scripts')
<script src="js/home.js"></script>
@endpush
