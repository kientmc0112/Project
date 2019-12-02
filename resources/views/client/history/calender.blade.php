@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/bower_FTMS/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
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
                        <div id="full-event-calendar"></div>
                        <!-- JS | Calendar Event Data -->
                        <script src="{{ asset('bower_components/bower_FTMS/js/calendar-events-data.js') }}"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
