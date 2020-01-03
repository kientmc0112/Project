@extends('admin.layouts.main') 
@section('title', config('configreport.show_comment')) 
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-user"></i>
                <span>List User</span>
                <div class="card-body">
                    <div>
                        <div class="bootstrap-table">
                            <div class="table-responsive">
                                <a href="{{ route('admin.reports.index') }}" class="btn btn-primary">Report</a>
                                <table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>User Mail</th>
                                            <th>Task Name</th>
                                            <th width='10%'>Status</th>
                                            <th width='30%'>Report</th>
                                            <th width='12%'>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userTask as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if ($user->id == $value->user_id)
                                                            {{ $user->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        @if ($user->id == $value->user_id)
                                                            {{ $user->email }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($tasks as $task)
                                                        @if ($task->id == $value->task_id)
                                                            {{ $task->name }}
                                                        @endif
                                                    @endforeach    
                                                </td>
                                                <td>
                                                    @if ($value->status == false)
                                                        <div class="alert alert-warning">Activity</div>
                                                    @else
                                                        <div class="alert alert-success">Finished</div>
                                                    @endif
                                                </td>
                                                <td>{{ $value->report }}</td>
                                                <td>
                                                    
                                                    @if ($value->status == false)
                                                        <form action="{{ route('admin.reports.finish', $value->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary">Finish</button>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{ $value->id }}"><i class="fas fa-comment-dots"></i></button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="btn btn-success">Finished</button>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{ $value->id }}"><i class="fas fa-comment-dots"></i></button>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            <form action="{{ route('admin.reports.store', $value->id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal fade" id="myModal{{ $value->id }}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>Report Trainee</h5>
                                                                <p> 
                                                                    {{ $value->report }}
                                                                </p>
                                                                <hr>
                                                                <h5>Comment Trainer</h5>
                                                                <p>{{ $value->comment }}</p>
                                                                @if ($value->status == false)
                                                                    <textarea class="form-control" name="comment" id="" cols="10" rows="5"></textarea>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                @if ($value->status == false)
                                                                    <button type="submit" class="btn btn-success">Confirm</button>
                                                                @else
                                                                    <div class="alert alert-success">
                                                                        Success
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </form>   
                                        @endforeach
                                    </tbody>
                                </table>
                                <div align='right'>
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Trở lại</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">tiếp theo</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
</div>
@endsection