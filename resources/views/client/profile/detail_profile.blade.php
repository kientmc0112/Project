@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/bower_FTMS/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">My Account</h2>
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

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-sx-12 col-sm-4 col-md-4">
                        <div>
                            <img src="{{ $user->avatar }}" alt="">
                        </div>
                        <div class="info p-20 bg-black-333">
                            <h4 class="text-uppercase text-white"><b>{{ $user->name }}</b></h4>
                            <ul class="list angle-double-right m-0">
                                <li class="mt-0 text-gray-silver"><strong class="text-gray-lighter">Email</strong>
                                    <br> {{ $user->email }}</li>
                                <li class="text-gray-silver"><strong class="text-gray-lighter">Phone</strong>
                                    <br> {{ $user->phone }}</li>
                                <li class="text-gray-silver"><strong class="text-gray-lighter">Address</strong>
                                    <br> {{ $user->address }}</li>
                            </ul>
                            <ul class="styled-icons icon-gray icon-circled icon-sm mt-15 mb-15">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                            @if ($check->id == $user->id)
                                <a class="btn btn-info btn-flat mt-10 mb-sm-30" href="{{ route('client.profile.edit', $user->id) }}">Edit Profile</a>    
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab" class="font-15 text-uppercase">Course <span class="badge">{{ count($userCourse) }}</span></a></li>
                                <li role="presentation"><a href="#free-orders" aria-controls="free-orders" role="tab" data-toggle="tab" class="font-15 text-uppercase">Subject <span class="badge">{{ count($userSubject) }}</span></a></li>
                                <li role="presentation"><a href="#bookmarks" aria-controls="bookmarks" role="tab" data-toggle="tab" class="font-15 text-uppercase">Task <span class="badge">{{ count($userTask) }}</span></a></li>
                                <li role="presentation"><a href="#report" aria-controls="report" role="tab" data-toggle="tab" class="font-15 text-uppercase">Report <span class="badge">1</span></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="orders">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Process</th>
                                                    <th>Day Start</th>
                                                    <th>Day Finish</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($course as $course)
                                                    <tr>
                                                        <th scope="row">#{{ $course->id }}</th>
                                                        <td>{{ $course->name }}</td>
                                                        <td>
                                                            @foreach ($userCourse as $item)
                                                                @if ($course->id == $item->course_id)
                                                                    @if ($item->status == 0)
                                                                        <button class="btn btn-warning btn-xs">Activity</button>
                                                                    @else
                                                                        <button class="btn btn-success btn-xs">Success</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourse as $item)
                                                                @if ($course->id == $item->course_id)
                                                                    {{ $item->process }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourse as $item)
                                                                @if ($course->id == $item->course_id)
                                                                    {{ $item->created_at }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($userCourse as $item)
                                                                @if ($course->id == $item->course_id)
                                                                    @if ($item->created_at != $item->updated_at)
                                                                        {{ $item->updated_at }}
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td><a class="btn btn-success btn-xs" href="#">View</a></td>
                                                    </tr>    
                                                @empty
                                                    <tr>
                                                        <td>User Chưa Tham Gia Course Nào!!!</td>
                                                    </tr>
                                                @endforelse
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="free-orders">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Process</th>
                                                <th>Day Start</th>
                                                <th>Day Finish</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($subject as $subject)
                                                <tr>
                                                    <th scope="row">#{{ $subject->id }}</th>
                                                    <td>{{ $subject->name }}</td>
                                                    <td>
                                                        @foreach ($userSubject as $item)
                                                            @if ($item->subject_id == $subject->id)
                                                                @if ($item->status == 0)
                                                                    <button class="btn btn-warning btn-xs">Activity</button>
                                                                @else
                                                                    <button class="btn btn-success btn-xs">Success</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($userSubject as $item)
                                                            @if ($item->subject_id == $subject->id)
                                                                {{ $item->process }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($userSubject as $item)
                                                            @if ($item->subject_id == $subject->id)
                                                                {{ $item->created_at }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($userSubject as $item)
                                                            @if ($subject->id == $item->subject_id)
                                                                @if ($item->created_at != $item->updated_at)
                                                                    {{ $item->updated_at }}
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View</a></td>
                                                </tr>    
                                            @empty
                                                <td>User Chua Tham Gia Subject!!!</td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="bookmarks">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Day Start</th>
                                                <th>Day Finish</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($task as $task)
                                                <tr>
                                                    <td>#{{ $task->id }}</td>
                                                    <td>{{ $task->name }}</td>
                                                    <td>
                                                        @foreach ($userTask as $item)
                                                            @if ($item->task_id == $task->id)
                                                                @if ($item->status == 0)
                                                                    <button class="btn btn-warning btn-xs">Activity</button>
                                                                @else
                                                                    <button class="btn btn-success btn-xs">Success</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($userTask as $item)
                                                            @if ($item->task_id == $task->id)
                                                                {{ $item->created_at }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($userTask as $item)
                                                            @if ($task->id == $item->task_id)
                                                                @if ($item->created_at != $item->updated_at)
                                                                    {{ $item->updated_at }}
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View</a></td>
                                                </tr>    
                                            @empty
                                                <td>User Chua Tham Gia Task</td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="report">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Day Start</th>
                                                    <th>Day Finish</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
