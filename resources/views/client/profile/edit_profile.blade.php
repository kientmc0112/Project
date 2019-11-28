@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/bower_FTMS/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">Edit profile</h2>
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pages</a></li>
                            <li class="active text-gray-silver">Page Title</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-sx-12 col-sm-4 col-md-4">
                        <div>
                            <img src="{{ $user->avatar }}" alt="">
                        </div>
                        <div class="info p-20 bg-black-333">
                            <h4 class="text-uppercase text-white">{{ $user->name }}</h4>
                            <ul class="list angle-double-right m-0">
                                <li class="mt-0 text-gray-silver"><strong class="text-gray-lighter">Email</strong>
                                    <br>{{ $user->email }}</li>
                                <li class="text-gray-silver"><strong class="text-gray-lighter">Web</strong>
                                    <br>{{ $user->phone }}</li>
                                <li class="text-gray-silver"><strong class="text-gray-lighter">Address</strong>
                                    <br>{{ $user->address }}</li>
                            </ul>
                            <ul class="styled-icons icon-gray icon-circled icon-sm mt-15 mb-15">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                            <a class="btn btn-info btn-flat mt-10 mb-sm-30" href="#">Edit Profile</a>
                            <a class="btn btn-danger btn-flat mt-10 mb-sm-30" href="#">Logout</a>
                        </div>
                    </div>
                    <form action="{{ route('client.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="icon-box mb-0 p-0">
                                <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                    <i class="fa fa-user"></i>
                                </a>
                                <h4 class="text-gray pt-10 mt-0 mb-30">Edit Profile</h4>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input name="name" class="form-control" type="text" value="{{ $user->name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input name="email" class="form-control" type="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input name="phone" class="form-control" type="text" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <input name="address" class="form-control" type="email" value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input name="password" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Repassword</label>
                                    <input name="repassword" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-lg mt-15" type="submit">Update</button>
                            </div>
                        <hr class="mt-70 mb-70">
                    </div>
                </form>
                    <div class="col-md-2">
                            <div class="form-group">
                                <label>Avatar</label>
                                <input id="img" type="file" name="avatar"
                                    class="form-control hidden" onchange="changeImg(this)">
                                <img id="avatar" class="thumbnail" src="/images/avatar.jpg">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
