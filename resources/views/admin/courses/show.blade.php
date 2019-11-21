@extends('admin.layouts.main')
@section('title', 'List Course')
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
                    <div class="row">
                        <div class="col-md-8">
                            <div>
                                <ul>
                                    <li><b>ID :</b> {{ $course->id }}</li>
                                    <li><b>Name :</b> {{ $course->name }}</li>
                                    <li><b>Status :</b>
                                        @if ($course->status == true)
                                        -----<b style="color: yellow"> Waiting</b>-----
                                        @else
                                        -----<b style="color: Green">Open</b>-----
                                        @endif
                                    </li>
                                    <li><b>Description :</b> {{ $course->description }}</li>
                                </ul>
                            </div>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục
                                </div>
                                @foreach ($subject as $item)
                                <div class="item-menu"><span>{{ $item->name }}</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary"
                                            href="{{ route('admin.subjects.edit', $item->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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
<!-- /#wrapper -->
@endsection
