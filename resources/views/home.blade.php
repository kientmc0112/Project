@extends('admin.layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="test">
                <button id="btn-test">add</button>
                <input type="text">
            </div>
            {{-- <div id="input" class="d-none">
                <input type="text">
            </div> --}}
            <p class="d-none" id="input">test</p>
        </div>
    </div>
</div>
@endsection
