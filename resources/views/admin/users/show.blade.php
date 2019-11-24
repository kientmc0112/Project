@extends('admin.layouts.main')
@section('title', 'Show User')
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
                        <div class="col-md-6">
                            <div>
                                <ul>
                                    <li><b>ID :</b> {{ $user->id }}</li>
                                    <li><b>Name :</b> {{ $user->name }}</li>
                                    <li><b>Email :</b> {{ $user->email }}</li>
                                    <li><b>Address :</b> {{ $user->address }}</li>
                                    <li><b>Phone :</b> {{ $user->phone }}</li>
                                    <li><b>Level :</b>
                                        @if ($user->role_id == false)
                                        Trainee
                                        @else
                                        Suppervisor
                                        @endif
                                    </li>
                                    <form action="{{ route('postShowUser', $user->id) }}" method="post">
                                        @csrf
                                        <li><b>Course :</b>
                                            <table>
                                                <tr>
                                                    <td><select name="course_id" id="" class="form-control">
                                                            @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}">{{ $course->name }}
                                                            </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><button class="btn btn-primary" type="submit">Submit</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục
                                </div>
                                @foreach ($user_course as $item)
                                <div class="item-menu"><span>{{ $item->name }}</span>
                                    <div class="category-fix">
                                        @if ($item->status == 0)
                                        <a class="btn-category btn-warning" href="#">Ativiting</a>
                                        @else
                                        <a class="btn-category btn-success" href="#">Success</a>
                                        @endif
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
