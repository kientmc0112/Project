<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="images/bg/bg2.jpg">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-5 mb-20" alt="" src="{{ asset('bower_components/assets-client/images/logo-white-footer.png') }}">
                    <p>{{ __('203, Envato Labs, Behind Alis Steet, Melbourne, Australia.') }}</p>
                    <ul class="list-inline mt-5">
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ __('123-456-789') }}</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ __('contact@yourdomain.com') }}</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">{{ __('www.yourdomain.com') }}</a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title">{{ __('Useful Links') }}</h4>
                    <ul class="list angle-double-right list-border">
                        <li><a href="page-about-style1.html">{{ __('About Us') }}</a></li>
                        <li><a href="page-course-list.html">{{ __('Our Courses') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title">{{ __('Twitter Feed') }}</h4>
                    <div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2">{{ __('Opening Hours') }}</h4>
                    <div class="opening-hours">
                        <ul class="list-border">
                            <li class="clearfix"> <span>{{ __('Mon - Tues :') }}</span>
                                <div class="value pull-right">{{ __('6.00 am - 10.00 pm') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ __('Wednes - Thurs :') }}</span>
                                <div class="value pull-right">{{ __('8.00 am - 6.00 pm') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ __('Fri :') }}</span>
                                <div class="value pull-right">{{ __('3.00 pm - 8.00 pm') }}</div>
                            </li>
                            <li class="clearfix"> <span>{{ __('Sun :') }}</span>
                                <div class="value pull-right">{{ __('Closed') }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-md-2">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">{{ __('Call Us Now') }}</h5>
                    <div class="text-gray">
                        {{ _('+61 3 1234 5678') }}
                        <br>{{ __('+12 3 1234 5678') }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">{{ __('Connect With Us') }}</h5>
                    <ul class="styled-icons icon-bordered icon-sm">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <div class="widget dark">
                    <h5 class="widget-title mb-10">{{ __('Subscribe') }}</h5>
                    <form id="mailchimp-subscription-form-footer" class="newsletter-form">
                        <div class="input-group">
                            <input type="email" value="" name="EMAIL" placeholder="Your Email" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer">
                            <span class="input-group-btn">
                                <button data-height="45px" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14" type="submit">{{ __('Subscribe') }}</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-black-333">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-11 text-black-777 m-0">{{ __('Copyright &copy;2016 ThemeMascot. All Rights Reserved') }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12">
                            <li>
                                <a href="#">{{ __('FAQ') }}</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">{{ __('Help Desk') }}</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">{{ __('Support') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
