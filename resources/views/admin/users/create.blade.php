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
                        <div class="col-sm-12 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
                            <!--/.row-->
                            <div class="row">
                                <div class="col-xs-6 col-md-12 col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <form action="{{ route('admin.users.store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @if ($errors->any())
                                                <div class="alert alert-danger"><i
                                                        class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first() }}</div>
                                                @endif
                                                @if (session('alert'))
                                                    <div class="alert alert-success">{{ session('alert') }}</div>
                                                @endif
                                                <div class="row" style="margin-bottom:40px">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>User Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>User Email</label>
                                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>User Password</label>
                                                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password" name="repassword" class="form-control" value="{{ old('repassword') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Adress</label>
                                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select name="role_id" class="form-control">
                                                                <option value="0">Trainee</option>
                                                                <option value="1">Supervisor</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-success" name="add-product"
                                                                type="submit">Add
                                                                User</button>
                                                            <button class="btn btn-danger" type="reset">Reset</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Avatar</label>
                                                            <input id="img" type="file" name="avatar"
                                                                class="form-control hidden" onchange="changeImg(this)">
                                                            <img id="avatar" class="thumbnail" width="100%"
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
