@extends('client.layouts.main')
@section('content')
<div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
        <div class="container pt-70 pb-20">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">Calender</h2>
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pages</a></li>
                            <li class="active text-gray-silver">Page Title</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="divider bg-lightest">
        <div class="container">
            <div class="section-content text-center">
                <div class="row">
                    <div class="col-md-12">
                        <div id='full-event-calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- <input type="hidden" id="calendarEvents" value="{{ json_encode($calendarEvents) }}"> --}}
<input type="hidden" id="calendar" value="{{ json_encode($tasks) }}">

<script>
    var calendarEvents = new Array();
    var tasks = $("#calendar").val();
    tasks = JSON.parse(tasks);
    for(var i=0; i<tasks.length; i++) {
        calendarEvents[i] = {
            'title': tasks[i]['id'],
            'start': tasks[i]['created_at'].slice(0, 10),
            'end': tasks[i]['updated_at'].slice(0, 10),
        };
        console.log(calendarEvents[i]);
    }
</script>
@endsection
