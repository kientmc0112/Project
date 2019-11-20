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
                            <div class="col-xs-12 col-md-12 col-lg-12">

                                <div class="panel panel-primary">

                                    <div class="panel-body">
                                        <div class="bootstrap-table">
                                            <div class="table-responsive">
                                                <a href="{{ route('admin.subjects.create') }}"
                                                    class="btn btn-primary">Thêm sản phẩm</a>
                                                <form action="{{ route('postShow') }}" method="post">
                                                    @csrf
                                                    <table class="table table-bordered" style="margin-top:20px;">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>
                                                                    <select id="courses_option" class="form-control"
                                                                        name="course_id"
                                                                        onchange=" return optionCourses()">
                                                                        <option>Courses</option>
                                                                        @foreach ($courses as $course)
                                                                        <option value="{{ $course->id }}">
                                                                            {{ $course->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <button id="btn-courses-option" class="d-none" type="submit">fill</button>
                                                                </th>
                                                                <th>Status</th>
                                                                <th>Description</th>
                                                                <th width='15%'>Tùy chọn</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($subjects as $subject)
                                                            <tr>
                                                                <td>{{ $subject->id }}</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p>Subject Name : {{ $subject->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @foreach ($subject->courses as $course)
                                                                    <ul>
                                                                        <li>{{ $course->name }}</li>
                                                                    </ul>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($subject->status == false)
                                                                    <button class="btn btn-success">Open</button>
                                                                    @else
                                                                    <button class="btn btn-warning">Waiting</button>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <p>{{ $subject->description }}</p>
                                                                </td>
                                                                <td>
                                                                    {{-- <form
                                                                        action="{{ route('admin.subjects.destroy', $subject->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                                                                            class="btn btn-warning"><i
                                                                                class="fas fa-edit"
                                                                                aria-hidden="true"></i></a>
                                                                        <button type="submit" class="btn btn-danger"><i
                                                                                class="fa fa-trash"
                                                                                aria-hidden="true"></i></button>
                                                                    </form> --}}
                                                                </td>
                                                            </tr>
                                                            @empty

                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </form>
                                                <div align='right'>
                                                    {{ $subjects->links() }}
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/.row-->
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
