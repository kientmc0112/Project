@extends('admin.layouts.main') 
@section('title', config('configsubject.show_comment')) 
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tables</li>
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
                                            <th>Status</th>
                                            <th width='30%'>Report</th>
                                            <th width='18%'>Tùy chọn</th>
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
                                                        <button class="btn btn-warning">Activity</button>
                                                    @else
                                                        <button class="btn btn-success">Finish</button>
                                                    @endif
                                                </td>
                                                <td>{{ $value->report }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fas fa-comment-dots"></i></button>
                                                </td>
                                            </tr>
                                                <div class="modal fade" id="myModal" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ $value->report }}</p>
                                                                <hr>
                                                                <textarea class="form-control" name="comment" id="" cols="10" rows="5">{{ $value->comment }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
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