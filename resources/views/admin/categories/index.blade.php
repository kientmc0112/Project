@extends('admin.layouts.main')
@section('title', 'List Category')
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
                <span>@yield('title')</span></a>
                <div class="card-body">
                    <div>
                        <div class="col-sm-12 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
                            <!--/.row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <br>
                                                    <a href="{{ route('admin.categories.create') }}">
                                                        <button class="btn btn-primary">{{ trans('setting.add_category') }}</button>
                                                    </a>
                                                    <br>
                                                    @if (session('alert'))
                                                    <hr>
                                                        <div class="alert alert-success">{{ session('alert') }}</div>
                                                    @endif
                                                    <hr>
                                                    <div class="vertical-menu">
                                                        <div class="item-menu active">{{ trans('setting.list_category') }}
                                                        </div>
                                                        
                                                        @include('admin.partials.categories_rows', ['level' => 0])
                                                    </div>
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
