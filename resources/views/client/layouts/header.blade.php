<div id="preloader">
    <div id="spinner">
        <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">{{ __('Disable Preloader') }}</div>
</div>
<header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center p-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget no-border m-0">
                        <ul class="list-inline font-13 sm-text-center mt-5">
                            <li>
                                <a class="text-white" href="#">{{ __('FAQ') }}</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="#">{{ __('Help Desk') }}</a>
                            </li>
                            <li class="text-white">|</li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                        <ul class="list-inline pull-right">
                            <li class="mb-0 pb-0">
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i class="fa fa-shopping-cart font-13"></i></a>
                                </div>
                            </li>
                            <li class="mb-0 pb-0">
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i class="fa fa-search font-13"></i> &nbsp;</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
                        <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                            <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-5">
                    <div class="widget no-border m-0">
                        <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="javascript:void(0)"><img src="{{ asset('bower_components/assets-client/images/logo-wide.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                        <ul class="list-inline">
                            <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                            <li>
                                <a href="#" class="font-12 text-gray text-uppercase">{{ __('Call us today!') }}</a>
                                <h5 class="font-14 m-0">{{ _('+(012) 345 6789') }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
                        <ul class="list-inline">
                            <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                            <li>
                                <a href="#" class="font-12 text-gray text-uppercase">{{ __('We are open!') }}</a>
                                <h5 class="font-13 text-black m-0"> {{ __('Mon-Fri 8:00-16:00') }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client.layouts.sidebar')
</header>
