<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from thememascot.net/demo/personal/s/studypress/v6.0/demo/form-login-style2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Dec 2018 20:04:02 GMT -->

<head>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="StudyPress | Education & Courses HTML Template" />
    <meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
    <meta name="author" content="ThemeMascot" />

    <!-- Page Title -->
    <title>StudyPress | Education & Courses HTML Template</title>

    <!-- Favicon and Touch Icons -->
    <link href="{{ asset('bower_components/assets-client/images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('bower_components/assets-client/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('bower_components/assets-client/images/apple-touch-icon-72x72.png') }}" rel="apple-touch-icon"
        sizes="72x72">
    <link href="{{ asset('bower_components/assets-client/images/apple-touch-icon-114x114.png') }}"
        rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('bower_components/assets-client/images/apple-touch-icon-144x144.png') }}"
        rel="apple-touch-icon" sizes="144x144">

    <!-- Stylesheet -->
    <link href="{{ asset('bower_components/assets-client/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/assets-client/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/assets-client/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/assets-client/css/css-plugin-collections.css') }}" rel="stylesheet" />
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins"
        href="{{ asset('bower_components/assets-client/css/menuzord-skins/menuzord-rounded-boxed.css') }}"
        rel="stylesheet" />
    <!-- CSS | Main style file -->
    <link href="{{ asset('bower_components/assets-client/css/style-main.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="{{ asset('bower_components/assets-client/css/preloader.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{ asset('bower_components/assets-client/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet"
        type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="{{ asset('bower_components/assets-client/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    {{-- <link href="{{ asset('bower_components/assets-client/css/style.css') }}" rel="stylesheet" type="text/css"> --}}

    <!-- CSS | Theme Color -->
    <link href="{{ asset('bower_components/assets-client/css/colors/theme-skin-color-set-1.css') }}" rel="stylesheet"
        type="text/css">

    <!-- external javascripts -->
    <script src="{{ asset('bower_components/assets-client/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets-client/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets-client/js/bootstrap.min.js') }}"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="{{ asset('bower_components/assets-client/js/jquery-plugin-collection.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
<![endif]-->
</head>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- preloader -->
        {{-- <div id="preloader">
            <div id="spinner">
                <div class="preloader-dot-loading">
                    <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                </div>
            </div>
            <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
        </div> --}}

        <!-- start main-content -->
        <div class="main-content">
            <!-- Section: home -->
            <section id="home" class="divider parallax fullscreen layer-overlay overlay-white-9"
                data-bg-img="{{ asset('bower_components/assets-client/images/bg/bg1.jpg') }}">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-push-3">
                                    <div class="text-center mb-60"><a href="#" class=""><img alt=""
                                                src="{{ asset('bower_components/assets-client/images/logo-wide.png') }}"></a>
                                    </div>
                                    <h4 class="text-theme-colored mt-0 pt-5"> Login</h4>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}</div>
                                    @endif
                                    <form name="login-form" class="form-transparent clearfix" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_username_email">Username/Email</label>
                                                <input style="color: black;" id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_password">Password</label>
                                                <input style="color: black" id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                            </div>
                                        </div>
                                        <div class="checkbox pull-left mt-15">
                                            <label for="form_checkbox">
                                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                Remember me </label>
                                        </div>
                                        <div class="form-group pull-right mt-10">
                                            <button style="display: block, overflow: auto" type="submit" name="Login" id="login" class="btn btn-dark btn-sm">Login</button>
                                        </div>
                                        <div class="clear text-center pt-10">
                                            <a class="text-theme-colored font-weight-600 font-12" href="#">Forgot Your
                                                Password?</a>
                                        </div>
                                        <div class="clear text-center pt-10">
                                            <a class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" href="#"
                                                data-bg-color="#3b5998">Login with facebook</a>
                                            <a class="btn btn-dark btn-lg btn-block no-border" href="#"
                                                data-bg-color="#00acee">Login with twitter</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- end main-content -->

        <!-- Footer -->
        <footer id="footer" class="footer text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0">Copyright ©2016 KodeSolution. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- end wrapper -->

    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <script src="{{ asset('bower_components/assets-client/js/custom.js') }}"></script>

</body>

<!-- Mirrored from thememascot.net/demo/personal/s/studypress/v6.0/demo/form-login-style2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Dec 2018 20:04:02 GMT -->

</html>
