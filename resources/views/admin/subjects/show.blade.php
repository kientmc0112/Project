@extends('admin.layouts.main')
@section('title', 'List Subject')
@section('content')
<!-- content -->
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-user"></i>
                <span>List User</span>
                <div class="card-body">
                    <div>
                        <!--/.row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <ul>
                                        <li><b>ID :</b> {{ $subject->id }}</li>
                                        <li><b>Name :</b> {{ $subject->name }}</li>
                                        <li><b>Status :</b>
                                            @if ($subject->status == true)
                                            -----<b style="color: yellow"> Waiting</b>-----
                                            @else
                                            -----<b style="color: Green">Open</b>-----
                                            @endif
                                        </li>
                                        <li><b>Description :</b> {{ $subject->description }}</li>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#myModal">Assign User</button>
                                    </ul>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <label for="">Assgin User</label>
                                            </div>
                                            <form action="{{ route('postShowSubject', $subject->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <select class="form-control" name="user_id">
                                                        @foreach ($listUser as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} |
                                                            {{ $user->email }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if (session('alert'))
                                <div class="alert alert-success">{{ session('alert') }}</div>
                                @endif
                                <div class="vertical-menu">
                                    <div class="item-menu active">Danh mục
                                    </div>
                                    @foreach ($tasks as $item)
                                    <div class="item-menu"><span>{{ $item->name }}</span></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>{{ trans('setting.id') }}</th>
                                            <th>{{ trans('setting.name') }}</th>
                                            <th>{{ trans('setting.email') }}</th>
                                            <th>{{ trans('setting.status') }}</th>
                                            <th>{{ trans('setting.process') }}</th>
                                            <th width='15%'>{{ trans('setting.options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><b>{{ $user->name }}</b></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($statusUser as $item)
                                                    @if ($item->user_id == $user->id)
                                                        @if ($item->status == 0)
                                                            <button class="btn btn-warning">{{ trans('setting.ativiting') }}</button>
                                                        @else
                                                            <button class="btn btn-success">{{ trans('setting.success') }}</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($statusUser as $item)
                                                    @if ($user->id == $item->user_id)
                                                        {{ $item->process }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <form id="finish-form" action="{{ route('putFinishSubject', $subject->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    @foreach ($statusUser as $item)
                                                        @if ($item->user_id == $user->id)
                                                            @if ($item->status == 0)
                                                                <input class="d-none" type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                                <button onclick="return checkConfirm()" type="submit" class="btn btn-info">Finish</button>
                                                            @else
                                                                <button class="btn btn-success">Finished</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>{{ trans('setting.subject_empty') }}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- end content -->
    <!-- /.content-wrapper -->
</div>
@endsection
