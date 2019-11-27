@extends('client.layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-pull-right" id="content">
                    <div class="single-service">
                        <img src="{{ $course->image }}" alt="">
                        <h3 class="text-theme-colored">{{ $course->name }}</h3>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30 ml-40">
                        <div class="widget">
                            <h4 class="widget-title line-bottom">{{ __('Course') }}</h4>
                            <div class="services-list">
                                <ul class="list list-border angle-double-right" id="list">
                                    <li class="active"><a href="{{ route('course.show', $course->id) }}">{{ __('Introduction')}}</a></li>
                                    @foreach($course->subjects as $subject)
                                        <li id="{{ $subject->id }}"><a>{{ $subject->name }}</a></li>
                                    @endforeach
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
            @foreach($course->subjects as $subject)
            $("#{{ $subject->id }}").on('click', function () {
                $.ajax({
                    method: 'GET',
                    dataType: 'html',
                    url: '{{ route('subject.show', $subject->id) }}',
                    success: function (response) {
                        $("#content").html(response);
                        $('#list li').removeClass('active');
                        $("#{{ $subject->id }}").addClass('active');
                    },
                    error: function (e) {
                        console.log(e.message);
                    }
                });
            })
            @endforeach
        })

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
