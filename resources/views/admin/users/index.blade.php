@extends('admin.layouts.main')
@section('title', 'List User')
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
                        <div class="bootstrap-table">
                            <div class="table-responsive">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm Thành viên</a>
                                <hr>
                                @if (session('alert'))
                                    <div class="alert alert-success"><i class="fas fa-check"></i>{{ session('alert') }}</div>
                                @endif
                                <table class="table table-bordered" style="margin-top:20px;">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>avatar</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Level</th>
                                            <th width='18%'>Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><b>{{ $user->name }} <b></td>
                                            <td><img id="avatar-user" src="{{ $user->avatar }}"></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <button class="btn 
                                                @if ($user->role_id == false)
                                                    btn-success    
                                                @else
                                                    btn-danger
                                                @endif
                                                ">
                                                    @if ($user->role_id == false)
                                                    Trainee
                                                    @else
                                                    Suppervisor
                                                    @endif
                                                </button>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                                <div align='right'>
                                    {{ $users->links() }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
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
