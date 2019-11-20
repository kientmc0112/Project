@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/bower_FTMS/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">My Account</h2>
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
                        <div class="doctor-thumb">
                            <img src="{{ asset('bower_components/bower_FTMS/images/about/profile1.jpg') }}" alt="">
                        </div>
                        <div class="info p-20 bg-black-333">
                            <h4 class="text-uppercase text-white">Jacob Smith</h4>
                            <p class="text-gray-silver">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore atque officiis maxime suscipit expedita obcaecati nulla in ducimus.</p>
                            <ul class="list angle-double-right m-0">
                                <li class="mt-0 text-gray-silver"><strong class="text-gray-lighter">Email</strong>
                                    <br> smith@yourdomain.com</li>
                                <li class="text-gray-silver"><strong class="text-gray-lighter">Web</strong>
                                    <br> www.yourdomain.com</li>
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
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab" class="font-15 text-uppercase">Orders <span class="badge">4</span></a></li>
                                <li role="presentation"><a href="#free-orders" aria-controls="free-orders" role="tab" data-toggle="tab" class="font-15 text-uppercase">Free Orders <span class="badge">3</span></a></li>
                                <li role="presentation"><a href="#bookmarks" aria-controls="bookmarks" role="tab" data-toggle="tab" class="font-15 text-uppercase">Bookmarks <span class="badge">5</span></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="orders">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Date</th>
                                                    <th>Payment</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">#1264</th>
                                                    <td>24/07/2016</td>
                                                    <td>PayPal</td>
                                                    <td>$127.50</td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">#1264</th>
                                                    <td>24/07/2016</td>
                                                    <td>PayPal</td>
                                                    <td>$127.50</td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">#1264</th>
                                                    <td>24/07/2016</td>
                                                    <td>PayPal</td>
                                                    <td>$127.50</td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">#1264</th>
                                                    <td>24/07/2016</td>
                                                    <td>PayPal</td>
                                                    <td>$127.50</td>
                                                    <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="free-orders">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Payment</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">#1189</th>
                                                <td>24/07/2016</td>
                                                <td>PayPal</td>
                                                <td>$127.50</td>
                                                <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#1189</th>
                                                <td>24/07/2016</td>
                                                <td>PayPal</td>
                                                <td>$127.50</td>
                                                <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#1189</th>
                                                <td>24/07/2016</td>
                                                <td>PayPal</td>
                                                <td>$127.50</td>
                                                <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#1189</th>
                                                <td>24/07/2016</td>
                                                <td>PayPal</td>
                                                <td>$127.50</td>
                                                <td><a class="btn btn-success btn-xs" href="#">View Order</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="bookmarks">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row"><img src="http://placehold.it/100x50" alt=""></th>
                                                <td>
                                                    <h4>Web Development Course</h3></h4>
                                                    <td>
                                                        <h4>$127.50</h3></h4>
                                                        <td>
                                                            <h4><a href="#"><i class="fa fa-close"></i></a></h3></h4>
                                            </tr>
                                            <tr>
                                                <th scope="row"><img src="http://placehold.it/100x50" alt=""></th>
                                                <td>
                                                    <h4>Software Development Course</h3></h4>
                                                    <td>
                                                        <h4>$127.50</h3></h4>
                                                        <td>
                                                            <h4><a href="#"><i class="fa fa-close"></i></a></h3></h4>
                                            </tr>
                                            <tr>
                                                <th scope="row"><img src="http://placehold.it/100x50" alt=""></th>
                                                <td>
                                                    <h4>App Development Course</h3></h4>
                                                    <td>
                                                        <h4>$127.50</h3></h4>
                                                        <td>
                                                            <h4><a href="#"><i class="fa fa-close"></i></a></h3></h4>
                                            </tr>
                                            <tr>
                                                <th scope="row"><img src="http://placehold.it/100x50" alt=""></th>
                                                <td>
                                                    <h4>Photoshop Course</h3></h4>
                                                    <td>
                                                        <h4>$127.50</h3></h4>
                                                        <td>
                                                            <h4><a href="#"><i class="fa fa-close"></i></a></h3></h4>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
