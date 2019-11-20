@extends('client.layouts.main')
@section('content')
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{ asset('bower_components/assets-client/images/bg/bg3.jpg') }}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white">Course Details</h2>
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
                <div class="col-md-8 blog-pull-right">
                    <div class="single-service">
                        <img src="{{ asset('bower_components/assets-client/images/services/lg9.jpg') }}" alt="">
                        <h3 class="text-theme-colored">Chemical Engineering</h3>
                        <h5><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo unde, <span class="text-theme-color-2">chemical engineering</span> corporis dolorum blanditiis ullam officia <span class="text-theme-color-2">our university </span>natus minima fugiat repellat! Corrupti voluptatibus aperiam voluptatem. Exercitationem, placeat, cupiditate.</em></h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore suscipit, inventore aliquid incidunt, quasi error! Natus esse rem eaque asperiores eligendi dicta quidem iure, excepturi doloremque eius neque autem sint error qui tenetur, modi provident aut, maiores laudantium reiciendis expedita. Eligendi</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore voluptatem officiis quod animi possimus a, iure nam sunt quas aperiam non recusandae reprehenderit, nesciunt cumque pariatur totam repellendus delectus? Maxime quasi earum nobis, dicta, aliquam facere reiciendis, delectus voluptas, ea assumenda blanditiis placeat dignissimos quas iusto repellat cumque.</p>
                        <h4 class="line-bottom mt-20 mb-20 text-theme-colored">All Courses Idea</h4>
                        <ul id="myTab" class="nav nav-tabs boot-tabs">
                            <li class="active"><a href="#small" data-toggle="tab">Categories</a></li>
                            <li><a href="#medium" data-toggle="tab">Categories</a></li>
                            <li><a href="#large" data-toggle="tab">Categories</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="small">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">Prices For All Lesson Type</td>
                                    </tr>
                                    <tr>
                                        <th>Coures Type</th>
                                        <th>Class time</th>
                                        <th>Course Duration</th>
                                        <th>Price</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Applied Psychology</th>
                                            <td>45 minutes</td>
                                            <td>3 years</td>
                                            <td>$810</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Business Administration (MBA)</th>
                                            <td>45 minutes</td>
                                            <td>2 years</td>
                                            <td>$940</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Computer Science (BSc)</th>
                                            <td>1 Hours</td>
                                            <td>4 years</td>
                                            <td>$1180</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Development Studies (MDS)</th>
                                            <td>1 Hours</td>
                                            <td>5 years</td>
                                            <td>$1400</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Engineering Technology (BSc)</th>
                                            <td>30 minutes</td>
                                            <td>3 years</td>
                                            <td>$600</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="medium">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">Prices For All Lesson Type</td>
                                    </tr>
                                    <tr>
                                        <th>Coures Type</th>
                                        <th>Class time</th>
                                        <th>Course Duration</th>
                                        <th>Price</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Applied Psychology</th>
                                            <td>45 minutes</td>
                                            <td>3 years</td>
                                            <td>$810</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Business Administration (MBA)</th>
                                            <td>45 minutes</td>
                                            <td>2 years</td>
                                            <td>$940</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Computer Science (BSc)</th>
                                            <td>1 Hours</td>
                                            <td>4 years</td>
                                            <td>$1180</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Development Studies (MDS)</th>
                                            <td>1 Hours</td>
                                            <td>5 years</td>
                                            <td>$1400</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Engineering Technology (BSc)</th>
                                            <td>30 minutes</td>
                                            <td>3 years</td>
                                            <td>$600</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="large">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center font-16 font-weight-600 bg-theme-color-2 text-white" colspan="4">Prices For All Lesson Type</td>
                                    </tr>
                                    <tr>
                                        <th>Coures Type</th>
                                        <th>Class time</th>
                                        <th>Course Duration</th>
                                        <th>Price</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Applied Psychology</th>
                                            <td>45 minutes</td>
                                            <td>3 years</td>
                                            <td>$810</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Business Administration (MBA)</th>
                                            <td>45 minutes</td>
                                            <td>2 years</td>
                                            <td>$940</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Computer Science (BSc)</th>
                                            <td>1 Hours</td>
                                            <td>4 years</td>
                                            <td>$1180</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Development Studies (MDS)</th>
                                            <td>1 Hours</td>
                                            <td>5 years</td>
                                            <td>$1400</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Engineering Technology (BSc)</th>
                                            <td>30 minutes</td>
                                            <td>3 years</td>
                                            <td>$600</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30 ml-40">
                        <div class="widget">
                            <h4 class="widget-title line-bottom">Courses <span class="text-theme-color-2">List</span></h4>
                            <div class="services-list">
                                <ul class="list list-border angle-double-right">
                                    <li><a href="page-courses-accounting-technologies.html">Accounting Technologies</a></li>
                                    <li class="active"><a href="page-courses-chemical-engineering.html">Chemical Engineering</a></li>
                                    <li><a href="page-courses-computer-technologies.html">Computer Technologies</a></li>
                                    <li><a href="page-courses-development-studies.html">Development Studies</a></li>
                                    <li><a href="page-courses-electrical-electronic.html">Electrical & Electronic</a></li>
                                    <li><a href="page-courses-modern-languages.html">Modern Languages</a></li>
                                    <li><a href="page-courses-modern-technologies.html">Modern Technologies</a></li>
                                    <li><a href="page-courses-software-engineering.html">Software Engineering</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            <h4 class="widget-title line-bottom">Opening <span class="text-theme-color-2">Hours</span></h4>
                            <div class="opening-hours">
                                <ul class="list-border">
                                    <li class="clearfix"> <span> Mon - Tues :  </span>
                                        <div class="value pull-right"> 6.00 am - 10.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Wednes - Thurs :</span>
                                        <div class="value pull-right"> 8.00 am - 6.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Fri : </span>
                                        <div class="value pull-right"> 3.00 pm - 8.00 pm </div>
                                    </li>
                                    <li class="clearfix"> <span> Sun : </span>
                                        <div class="value pull-right"> Colosed </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
