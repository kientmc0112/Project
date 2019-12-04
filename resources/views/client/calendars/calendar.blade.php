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
<script>
    var calendarEvents = [];

</script>
@endsection
