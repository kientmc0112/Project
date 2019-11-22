@extends('admin.layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p></p>
 
            <select id="single">
              <option>Single</option>
              <option>Single2</option>
            </select>
             
            <select id="multiple" multiple="multiple">
              <option selected="selected">Multiple</option>
              <option>Multiple2</option>
              <option selected="selected">Multiple3</option>
            </select>
        </div>
    </div>
</div>
@endsection
