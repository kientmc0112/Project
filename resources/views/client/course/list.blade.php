@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/assets-client/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">Course List</h2>
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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 blog-pull-right">
                    <div class="row mb-15">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumb"> <img alt="featured project" src="{{ asset('bower_components/assets-client/images/project/lg1.jpg') }}" class="img-fullwidth"></div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20">Accounting Technologies</h4>
                            <ul class="review_text list-inline">
                                <li>
                                    <h4 class="mt-0"><span class="text-theme-color-2">Price :</span> $125</h4></li>
                                <li>
                                    <div class="star-rating" title="Rated 4.50 out of 5"><span style="width: 90%;">4.50</span></div>
                                </li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.Aliquam ipsum quis ipsum facilisis sit ame ipsum quis ipsum facilisis sit amet facilisis consecte.</p>
                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="page-courses-accounting-technologies.html">view details</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-15">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumb"> <img alt="featured project" src="{{ asset('bower_components/assets-client/images/project/lg2.jpg') }}" class="img-fullwidth"></div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20">Development Studies</h4>
                            <ul class="review_text list-inline">
                                <li>
                                    <h4 class="mt-0"><span class="text-theme-color-2">Price :</span> $125</h4></li>
                                <li>
                                    <div class="star-rating" title="Rated 4.50 out of 5"><span style="width: 90%;">4.50</span></div>
                                </li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.Aliquam ipsum quis ipsum facilisis sit ame ipsum quis ipsum facilisis sit amet facilisis consecte.</p>
                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="page-courses-development-studies.html">view details</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-15">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumb"> <img alt="featured project" src="{{ asset('bower_components/assets-client/images/project/lg3.jpg') }}" class="img-fullwidth"></div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20">Modern Technologies</h4>
                            <ul class="review_text list-inline">
                                <li>
                                    <h4 class="mt-0"><span class="text-theme-color-2">Price :</span> $125</h4></li>
                                <li>
                                    <div class="star-rating" title="Rated 4.50 out of 5"><span style="width: 90%;">4.50</span></div>
                                </li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.Aliquam ipsum quis ipsum facilisis sit ame ipsum quis ipsum facilisis sit amet facilisis consecte.</p>
                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="page-courses-chemical-engineering.html">view details</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-15">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumb"> <img alt="featured project" src="{{ asset('bower_components/assets-client/images/project/lg4.jpg') }}" class="img-fullwidth"></div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4 class="line-bottom mt-0 mt-sm-20">Computer Technologies</h4>
                            <ul class="review_text list-inline">
                                <li>
                                    <h4 class="mt-0"><span class="text-theme-color-2">Price :</span> $125</h4></li>
                                <li>
                                    <div class="star-rating" title="Rated 4.50 out of 5"><span style="width: 90%;">4.50</span></div>
                                </li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ipsum quis ipsum facilisis sit amet.Aliquam ipsum quis ipsum facilisis sit ame ipsum quis ipsum facilisis sit amet facilisis consecte.</p>
                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="page-courses-modern-languages.html">view details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar sidebar-left mt-sm-30">
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Search <span class="text-theme-color-2">Courses</span></h5>
                            <div class="search-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" placeholder="Click to Search" class="form-control search-input">
                                        <span class="input-group-btn">
                          <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                          </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Course <span class="text-theme-color-2">Categories</span></h5>
                            <div class="categories">
                                <ul class="list list-border angle-double-right">
                                    <li><a href="#">Creative<span>(19)</span></a></li>
                                    <li><a href="#">Portfolio<span>(21)</span></a></li>
                                    <li><a href="#">Fitness<span>(15)</span></a></li>
                                    <li><a href="#">Gym<span>(35)</span></a></li>
                                    <li><a href="#">Personal<span>(16)</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <nav>
                        <ul class="pagination theme-colored xs-pull-center m-0">
                            <li>
                                <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">...</a></li>
                            <li>
                                <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
