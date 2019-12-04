@extends('admin.layouts.main')
@section('title', 'Show Course')
@section('content')
<!-- content -->
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">{{ trans('setting.courses') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chalkboard-teacher"></i> |
                <span>@yield('title')</span>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <ul>
                                    <li><b>{{ trans('setting.id') }} :</b> {{ $course->id }}</li>
                                    <li><b>{{ trans('setting.name') }} :</b> {{ $course->name }}</li>
                                    <li><b>{{ trans('setting.status') }} :</b>
                                        @if ($course->status == true)
                                        -----<b style="color: yellow"> {{ trans('setting.waiting') }}</b>-----
                                        @else
                                        -----<b style="color: Green">{{ trans('setting.open') }}</b>-----
                                        @endif
                                    </li>
                                    <li><b>{{ trans('setting.description') }} :</b> {{ $course->description }}</li>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#myModal">{{ trans('setting.assign') }}</button>
                                </ul>
                            </div>
                            @if (session('alert'))
                                <div class="alert alert-success">{{ session('alert') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <label for="">{{ trans('setting.assign') }}</label>
                                        </div>
                                        <form action="{{ route('assignTraineeCourse', $course->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="">User</label>
                                                <select class="form-control" name="user_id">
                                                    @foreach ($listUser as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} |
                                                        {{ $user->email }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <label for="">Subject</label>
                                                <select class="form-control" name="subject_id" id="">
                                                    @foreach ($listSubject as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">{{ trans('setting.add') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-menu">
                                <div class="item-menu active">{{ trans('setting.list_subject') }}</div>
                                @foreach ($listSubject as $subject)
                                <div class="item-menu"><span>{{ $subject->name }}</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary"
                                            href="{{ route('admin.subjects.edit', $subject->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
                                    </div>
                                </div>
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
                                    @forelse ($userCourse as $user)
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
                                                        <button class="btn btn-warning">{{ trans('setting.activity') }}</button>
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
                                            <form id="finish-form" action="{{ route('finishTraineeCourse', $course->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            @foreach ($statusUser as $item)
                                                @if ($item->user_id == $user->id)
                                                    @if ($item->status == 0)
                                                        <input class="d-none" type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                        <button onclick="return checkConfirm()" type="submit" class="btn btn-info">{{ trans('setting.finish') }}</button>
                                                    @else
                                                        <button class="btn btn-success">{{ trans('setting.finished') }}</button>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>{{ trans('setting.course_empty') }}
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
                <span>{{ trans('setting.sticky_footer') }}</span>
            </div>
        </div>
    </footer>

</div>
<!-- end content -->
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection
