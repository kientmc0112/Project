@extends('client.layouts.main') @section('content')
<div class="main-content">
    <section>
        <div class="container pb-60">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="meet-doctors">
                            <h2 class="text-uppercase mt-0 line-height-1">Welcome To <span class="text-theme-colored">Education</span></h2>
                            <h6 class="text-uppercase letter-space-5 line-bottom title font-playfair text-uppercase">Gravida vitae Dapibus Education</h6>
                            <p>Cum sociis natoque penatibus et ultrices volutpat. Nullam wisi ultricies a, gravida vitae, dapibus risus ante sodales lectus.Cum sociis natoque penatibus et ultrices volutpat. Nullam wisi ultricies a, gravida vitae, dapibus risus ante sodales lectus</p>
                        </div>
                        <div class="row mb-sm-30">
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0 mb-20">
                                    <a class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-scissors text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Less CSS</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0 mb-20">
                                    <a class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-pen text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Easy Customiz</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0 mb-20">
                                    <a class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-tools text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Special ShortCode</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0 mb-20">
                                    <a class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-vector text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">W3 validation</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0">
                                    <a class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-phone text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Responsive</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="icon-box p-0">
                                    <a class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-sm pull-left sm-pull-none flip" href="#">
                                        <i class="pe-7s-light text-white"></i>
                                    </a>
                                    <div class="ml-70 ml-sm-0">
                                        <h5 class="icon-box-title mt-10 text-uppercase letter-space-2 mb-10">Retina Ready</h5>
                                        <p class="text-gray">Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-30 mt-0 bg-theme-colored">
                            <h3 class="title-pattern mt-0"><span class="text-white">Request <span class="text-theme-color-2">Information</span></span></h3>
                            <!-- Appilication Form Start-->
                            <form id="reservation_form" name="reservation_form" class="reservation-form mt-20" method="post" action="http://thememascot.net/demo/personal/s/studypress/v6.0/demo/includes/reservation.php">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <input placeholder="Enter Name" type="text" id="reservation_name" name="reservation_name" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-20">
                                            <input placeholder="Email" type="text" id="reservation_email" name="reservation_email" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-20">
                                            <input placeholder="Phone" type="text" id="reservation_phone" name="reservation_phone" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-20">
                                            <div class="styled-select">
                                                <select id="person_select" name="person_select" class="form-control" required="">
                                                    <option value="">Choose Subject</option>
                                                    <option value="1 Person">Software Engineering</option>
                                                    <option value="2 Person">Computer Science engineering</option>
                                                    <option value="3 Person">Accounting Technologies</option>
                                                    <option value="Family Pack">BACHELOR`S DEGREE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-20">
                                            <input name="Date Of Birth" class="form-control required date-picker" type="text" placeholder="Date Of Birth" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea placeholder="Enter Message" rows="3" class="form-control required" name="form_message" id="form_message" aria-required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-0 mt-10">
                                            <input name="form_botcheck" class="form-control" type="hidden" value="">
                                            <button type="submit" class="btn btn-colored btn-theme-color-2 text-white btn-lg btn-block" data-loading-text="Please wait...">Submit Request</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Application Form End-->

                            <!-- Application Form Validation Start-->
                            <script type="text/javascript">
                                $("#reservation_form").validate({
                                    submitHandler: function(form) {
                                        var form_btn = $(form).find('button[type="submit"]');
                                        var form_result_div = '#form-result';
                                        $(form_result_div).remove();
                                        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                                        var form_btn_old_msg = form_btn.html();
                                        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                        $(form).ajaxSubmit({
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.status == 'true') {
                                                    $(form).find('.form-control').val('');
                                                }
                                                form_btn.prop('disabled', false).html(form_btn_old_msg);
                                                $(form_result_div).html(data.message).fadeIn('slow');
                                                setTimeout(function() {
                                                    $(form_result_div).fadeOut('slow')
                                                }, 6000);
                                            }
                                        });
                                    }
                                });
                            </script>
                            <!-- Application Form Validation Start -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-lighter">
        <div class="container pb-40">
            <div class="section-title mb-0">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="text-uppercase font-28 line-bottom mt-0 line-height-1">Our <span class="text-theme-color-2 font-weight-400">COURSES</span></h2>
                        <h4 class="pb-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h4>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-sm-6 col-md-3">
                            <div class="service-block bg-white">
                                <div class="thumb"> <img alt="featured project" src="{{ $course->image }}" class="img-fullwidth"> </div>
                                <div class="content text-left flip p-25 pt-0">
                                    <h4 class="line-bottom mb-10">{{ $course->name }}</h4>
                                    <p>{{ $course->description }}</p>
                                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="{{ route('course.show', $course->id) }}">view details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="event">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ asset('bower_components/assets-client/images/photos/1.jpg') }}" class="img-fullwidth" alt="">
                    </div>
                    <div class="col-md-7 pb-sm-20">
                        <h3 class="title line-bottom mb-20 font-28 mt-0 line-height-1">Why <span class="text-theme-color-2 font-weight-400">Choose Us</span> ?</h3>
                        <p class="mb-20">The Cweren Law Firm is a recognized leader in landlord tenant representation throughout Texas.The largests professional property management companies the region.The largest professional property management companies is a recognized leader in landlord tenant representation throughout Texas</p>
                        <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="icon-box text-center pl-0 pr-0 mb-0">
                                <a href="#" class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-md">
                                    <i class="pe-7s-phone text-white"></i>
                                </a>
                                <h5 class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase"><strong>Responsive</strong></h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="icon-box text-center pl-0 pr-0 mb-0">
                                <a href="#" class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-md">
                                    <i class="pe-7s-pen text-white"></i>
                                </a>
                                <h5 class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase"><strong>validation</strong></h5>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="icon-box text-center pl-0 pr-0 mb-0">
                                <a href="#" class="icon bg-theme-colored icon-circled icon-border-effect effect-circle icon-md">
                                    <i class="pe-7s-light text-white"></i>
                                </a>
                                <h5 class="icon-box-title mt-15 mb-0 letter-space-4 text-uppercase"><strong>CERTIFICATION</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-60">
            <div class="section-title mb-0">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 text-uppercase font-28 line-bottom">Our <span class="text-theme-color-2 font-weight-400">TRAINER</span></h2>
                        <h4 class="pb-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h4>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row multi-row-clearfix">
                    @foreach ($users as $user)
                        <div class="col-sm-6 col-md-3 mb-sm-30 sm-text-center">
                            <div class="team maxwidth400">
                                <div class="thumb"><img class="img-fullwidth" src="{{ $user->avatar }}" alt=""></div>
                                <div class="content border-1px p-15 bg-light clearfix">
                                    <h4 class="name text-theme-color-2 mt-0">{{ $user->name }} - <small>Trainer</small></h4>
                                    <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                    <a class="btn btn-theme-colored btn-sm pull-right flip" href="{{ route('user.show', $user->id) }}">view details</a>
                                </div>
                            </div>
                        </div>    
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
