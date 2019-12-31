@extends('admin.layouts.main')
@section('title', 'List Course')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">{{ trans('setting.courses') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chalkboard-teacher"></i> |
                <span> @yield('title') </span></a>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="bootstrap-table">
                                            <div class="table-responsive">
                                                <a href="{{ route('admin.courses.create') }}"
                                                    class="btn btn-primary">{{ trans('setting.add_course') }}</a>
                                                <hr>
                                                @if (session('alert'))
                                                    <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('alert') }}</div>
                                                @endif
                                                <table class="table table-bordered" style="margin-top:20px;">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th id="th-id">{{ trans('setting.id') }}</th>
                                                            <th>{{ trans('setting.name') }}</th>
                                                            <th>{{ trans('setting.image') }}</th>
                                                            <th>{{ trans('setting.categories') }}</th>
                                                            <th id="th-status" style="width: 10%;">{{ trans('setting.status') }}</th>
                                                            <th>{{ trans('setting.description') }}</th>
                                                            <th id="th-option" style="width: 13%">{{ trans('setting.options') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($courses as $key => $course)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p><b>{{ $course->name }}</b></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><img style="width: 100px; height: 100px;" src="{{ $course->image }}" alt=""></td>
                                                            <td>{{ $course->category->name }}</td>
                                                            <td>
                                                                <a class="alert @if ($course->status == 0)
                                                                        alert-success
                                                                    @else
                                                                        alert-warning
                                                                    @endif "><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i>
                                                                    @if ($course->status == 0)
                                                                        {{ trans('setting.open') }}
                                                                    @else
                                                                        {{ trans('setting.waiting') }}
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <p>{{ $course->description }}</p>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                                    <button class="btn btn-danger checkconfirm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                                                <div align='right'>
                                                    {{ $courses->links() }}
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>{{ trans('setting.sticky_footer') }}</span>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
