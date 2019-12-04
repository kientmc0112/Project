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
            <div>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add
                    Event</button>
                <hr>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        {{-- <form action="{{ route('postCalendar') }}" method="POST">
                            @csrf --}}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Create Event</h4>
                                </div>
                                <div class="modal-body form-group">
                                    <div class="form-group">
                                        <label>Title Event</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="date" class="form-control" name="start">
                                    </div>
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <input type="date" class="form-control" name="end">
                                    </div>
                                    <div class="form-group section-content text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <hr>
            </div>
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
        calendarEvents[i] = [
            'title': tasks[i]['id'],
            'start': tasks[i]['created_at'].slice(0, 10),
            'end': tasks[i]['updated_at'].slice(0, 10),
        ];
        $('#full-event-calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            editable: true,
            eventLimit: true,
            events: calendarEvents[i]
        });
    }



    // var a = $('#calendarEvents').val();
    // @foreach($tasks as $task)
    //     var calendarEvents;
    //     calendarEvents = [
    //         {
    //             title: '{{ $task->id }}',
    //             start: '{{ substr($task->created_at, 0, 10) }}',
    //             end: '{{ substr($task->updated_at, 0, 10) }}',
    //         }
    //     ];
    // @endforeach

    // $.ajax({
    //     type: 'POST',
    //     url: '/calendars/show',
    //     success: function (response) {
    //         $.each(response.tasks, function (key, value) {
    //             calendarEvents = [
    //                 {
    //                     title: "'" + value.id.toString() + "'",
    //                     start: "'" + value.created_at.slice(0, 10) + "'",
    //                     end: "'" + value.updated_at.slice(0, 10) + "'",
    //                 }
    //             ];
    //         });
    //     },
    //     error: function(response) {
    //         console.log(response);
    //         alert("Error! Please refresh");
    //     }
    // });

</script>
@endsection
