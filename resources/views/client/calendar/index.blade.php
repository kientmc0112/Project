@extends('client.layouts.main')
@section('content')
<div class="main-content">
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

{{-- <input type="hidden" id="task-calendar" value="{{ json_encode($taskCalendar) }}"> --}}
<input type="hidden" id="subject-calendar" value="{{ json_encode($subjectCalendar) }}">
{{-- <input type="hidden" id="course-calendar" value="{{ json_encode($courseCalendar) }}"> --}}

<script>

    // var calendarEvents = new Array();
    // var tasks = $("#task-calendar").val();
    // tasks = JSON.parse(tasks);
    // console.log(tasks);
    // for(var i=0; i<tasks.length; i++) {
    //     calendarEvents[i] = {
    //         'title': tasks[i]['name'],
    //         'start': tasks[i]['created_at'].slice(0, 10),
    //         'end': tasks[i]['updated_at'].slice(0, 10),
    //         'textColor': 'black',
    //         'backgroundColor': '#33ccff',
    //     };
    // };

    var calendarEvents = new Array();
    var subjects = $("#subject-calendar").val();
    subjects = JSON.parse(subjects);
    console.log(subjects);
    for(var i = 0; i < subjects.length; i++) {
        calendarEvents[i] = {
            'title': subjects[i]['name'],
            'start': subjects[i]['created_at'].slice(0, 10),
            'end': subjects[i]['updated_at'].slice(0, 10),
            'textColor': 'black',
            'backgroundColor': subjects[i]['color'],
        };
    }

    // var calendarEvents2 = new Array();
    // var courses = $("#course-calendar").val();
    // courses = JSON.parse(courses);
    // console.log(courses);
    // for(var i=0; i<courses.length; i++) {
    //     calendarEvents2[i] = {
    //         'title': courses[i]['name'],
    //         'start': courses[i]['created_at'].slice(0, 10),
    //         'end': courses[i]['updated_at'].slice(0, 10),
    //         'textColor': 'black',
    //         'backgroundColor': '#ff8000',
    //     };
    // }

    // calendarEvents = calendarEvents.concat(calendarEvents1, calendarEvents2);
</script>
@endsection
