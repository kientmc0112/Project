@extends('admin.layouts.main')
@section('title', 'Edit Course')
@section('content')
<!-- content -->
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.courses.index') }}">{{ trans('setting.courses') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chalkboard-teacher"></i> |
                <span> @yield('title') </span></a>
                <div class="card-body">
                    <div>
                        <!--/.row-->
                        <div class="col-sm-12 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
                            <!--/.row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form action="{{ route('admin.courses.update', $course->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        @if ($errors->any())
                                                        <div class="alert alert-danger"><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $errors->first() }}</div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for=""> {{ trans('setting.category') }} :</label>
                                                            <select class="form-control" name="category_id" id="">
                                                                @forelse ($categories as $category)
                                                                <option @if ($category->id == $course->category_id)
                                                                    selected
                                                                    @endif
                                                                    value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                                @empty
                                                                <option value="">-----{{ trans('setting.empty') }}-----
                                                                </option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.name') }}</label>
                                                            <input type="text" class="form-control" name="name" id=""
                                                                value="{{ $course->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.status') }}</label>
                                                            <select class="form-control" name="status" id="">
                                                                <option @if ($course->status = 0)
                                                                    selected
                                                                    @endif
                                                                    value="0">{{ trans('setting.open') }}</option>
                                                                <option @if ($course->status = 1)
                                                                    selected
                                                                    @endif
                                                                    value="1">{{ trans('setting.waiting') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.description') }}</label>
                                                            <textarea class="form-control" name="description" id=""
                                                                cols="30"
                                                                rows="10">{{ $course->description }}</textarea>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ trans('setting.edit_course') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.row-->
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
