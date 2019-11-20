@extends('admin.layouts.main')
@section('title', 'Create Category')
@section('content')
<!-- content -->
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.categories.index') }}">{{ trans('setting.categories') }}</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-tasks"></i> |
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
                                                <div class="col-md-5">
                                                    <form action="{{ route('admin.categories.store') }}" method="POST">
                                                        @csrf
                                                        @if ($errors->any())
                                                        <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>  {{ $errors->first() }}</div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.category_parent') }}:</label>
                                                            <select class="form-control" name="parent_id"
                                                                id="parent_id">
                                                                <option value="0">----{{ trans('setting.root') }}----</option>
                                                                @include('admin.partials.categories_options', ['level'
                                                                => 0])
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.category_name') }}</label>
                                                            <input type="text" class="form-control" name="name" id=""
                                                                placeholder="Tên danh mục mới">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{ trans('setting.description') }}</label>
                                                            <textarea class="form-control" name="description" id=""
                                                                cols="30" rows="10"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">{{ trans('setting.add_category') }}</button>
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
