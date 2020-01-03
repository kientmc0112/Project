@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-pull-right" id="content">
                    <div class="single-service">
                        <img src="{{ $course->image }}" alt="">
                        <h3 class="text-theme-colored">{{ $course->name }}</h3>
                        <em data-toggle="modal" data-target="#myModal"><a>{{ $course->users->count() }} {{ trans('layouts.member') }}</a></em>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('layouts.member') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless table-striped">
                                            @foreach ($course->users as $user)
                                                <tr>
                                                    <th class="col-xs-1"><img src="{{ $user->avatar }}"></th>
                                                    <th><h5><b>{{ $user->name }}</b></h5></th>
                                                    <th class="col-xs-1"><a href="{{ route('user.show', $user->id) }}" class="btn btn-success">{{ trans('layouts.viewP') }}</a></th>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('layouts.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>{{ $course->description }}</p>
                        @foreach ($course->users as $user)
                            @if ($user->id == Auth::user()->id)
                                <p>{{ trans('layouts.Complete') }}{{ ': ' .$user->pivot->status . '/' . $course->subjects->count() }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30 ml-40">
                        <div class="widget">
                            <h4 class="widget-title line-bottom">{{ trans('layouts.course') }}
                            <strong>{{ $course->name }}</strong></h4>
                            <div class="services-list">
                                <ul class="list list-border angle-double-right" id="list">
                                    <li class="active" style="display: block" id="introduction"><a id="intro" href="{{ route('course.show', $course->id) }}">{{ trans('layouts.intro') }}</a>
                                    </li>
                                    @foreach ($course->subjects as $subject)
                                        <li class='ml-20' id="subject{{ $subject->id }}" value="{{ $course->id }}"><a>{{ $subject->name }}</a></li>
                                    @endforeach
                                    <li id="history{{ $course->id }}" value="{{ $course->id }}"><a>{{ trans('layouts.history') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready( function () {
            $("#list li").on('click', function () {
                var id = this.id;
                var course_id = this.value;
                $("#list li").removeClass('active');
                $("#" + id).addClass('active');
                if(id.replace('history', '') != course_id) {
                    id = id.replace('subject', '');
                    $.ajax({
                        method: 'POST',
                        dataType: 'html',
                        url: '/subjects/' + id + '/show',
                        data: {
                            course_id: course_id,
                        },
                        success: function (response) {
                            $("#content").html(response);
                        },
                        error: function (e) {
                            console.log(e.message);
                        }
                    });
                }
                else {
                    $.ajax({
                        method: 'GET',
                        dataType: 'html',
                        url: '/courses/' + course_id + '/history',
                        success: function (response) {
                            $("#content").html(response);
                        },
                        error: function (e) {
                            console.log(e.message);
                        }
                    });
                }
            });
        });
        // function readSubject(id, course_id, user_id) {
        //     var idJquery = "#" + id;
        //     $.ajax({
        //         method: 'POST',
        //         dataType: 'html',
        //         url: '/subjects/' + id + '/show',
        //         data: {
        //             course_id: course_id,
        //             user_id: user_id,
        //         },
        //         success: function (response) {
        //             $("#content").html(response);
        //             $('#list li').removeClass('active');
        //             $('#list ' + idJquery).addClass('active');
        //         },
        //         error: function (e) {
        //             console.log(e.message);
        //         }
        //     });
        // }

        // $(document).ready( function () {
        //     @foreach($course->subjects as $subject)
        //     $("#{{ $subject->id }}").on('click', function () {
        //         $.ajax({
        //             method: 'GET',
        //             dataType: 'html',
        //             url: '{{ route('subject.show', $subject->id) }}',
        //             success: function (response) {
        //                 $("#content").html(response);
        //                 $('#list li').removeClass('active');
        //                 $("#{{ $subject->id }}").addClass('active');
        //             },
        //             error: function (e) {
        //                 console.log(e.message);
        //             }
        //         });
        //     })
        //     @endforeach
        // })

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        //     console.log(id);
        //     $.ajaxSetup({
        //         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        // });

        // $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    </script>
@endsection
