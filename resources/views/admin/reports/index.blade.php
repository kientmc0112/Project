@extends('admin.layouts.main') 
@section('title', config('configreport.list_reports')) 
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
                                <a href="{{ route('admin.reports.comment') }}" class="btn btn-warning">Commented</a>
                                <table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>User Mail</th>
                                            <th>Task Name</th>
                                            <th width='10%'>Status</th>
                                            <th width='30%'>Report</th>
                                            <th width='5%'>Options</th>
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
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{ $value->id }}"><i class="fas fa-comment-dots"></i></button>
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
                                                                <p>{{ $value->report }}</p>
                                                                <hr>
                                                                <textarea class="form-control" name="comment" id="" cols="10" rows="5" required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Confirm</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </form>   
                                        @endforeach
                                    </tbody>
                                </table>
                                <div align='right'>
                                    <div>{{ $userTask->links() }}</div>
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