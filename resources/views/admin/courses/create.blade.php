@extends('admin.layouts.main')
@section('title', 'Create Course')
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
                                            <form action="{{ route('admin.courses.store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first() }}</div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.category') }} :</label>
                                                            <select class="form-control" name="category_id" id="">
                                                                @include('admin.partials.categories_options', ['level'
                                                                => 0])
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.name') }}</label>
                                                            <input type="text" class="form-control" name="name" id="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.status') }}</label>
                                                            <select class="form-control" name="status" id="">
                                                                <option value="0">{{ trans('setting.open') }}</option>
                                                                <option value="1">{{ trans('setting.waiting') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <table id="add_main" class="table">
                                                                <label for="">{{ trans('setting.subject') }}</label>
                                                                <tr>
                                                                    <td><select name="subject_id[]" id="subject_id"
                                                                            class="form-control">
                                                                            @foreach ($subjects as $subject)
                                                                                <option value="{{ $subject->id }}">
                                                                                    {{ $subject->name }}</option>
                                                                            @endforeach
                                                                        </select></td>
                                                                    <td><button type="button" id="btn_add"
                                                                            name="btn_add"
                                                                            class="btn btn-primary">Add</button></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.description') }}</label>
                                                            <textarea class="form-control" name="description" id=""
                                                                cols="30" rows="10"></textarea>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ trans('setting.add_course') }}</button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Course Image</label>
                                                            <input id="img" type="file" name="image"
                                                                class="form-control hidden" onchange="changeImg(this)">
                                                            <img id="image" class="thumbnail" width="100%"
                                                                height="350px" src="/images/avatar.jpg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
        <div class="form-group d-none" id="option_subject">
            <table id="input" class="table">
                <tr>
                    <td><select name="subject_id[]" id="subject_id" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select></td>
                    <td><button type="button" id="btn_remove" name="btn_remove" class="btn btn-danger">X</button></td>
                </tr>
            </table>
        </div>
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
