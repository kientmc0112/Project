<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="StudyPress | Education & Courses HTML Template" />
    <meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
    <meta name="author" content="ThemeMascot" />
    <title>{{ __('ftms') }}</title>
    <link href="{{ asset('bower_components/bower_FTMS/images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('bower_components/bower_FTMS/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('bower_components/bower_FTMS/images/apple-touch-icon-72x72.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('bower_components/bower_FTMS/images/apple-touch-icon-114x114.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('bower_components/bower_FTMS/images/apple-touch-icon-144x144.png') }}" rel="apple-touch-icon" sizes="144x144">
    <link href="{{ asset('bower_components/bower_FTMS/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/css-plugin-collections.css') }}" rel="stylesheet" />
    <link id="menuzord-menu-skins" href="{{ asset('bower_components/bower_FTMS/css/menuzord-skins/menuzord-rounded-boxed.css') }}" rel="stylesheet" />
    <link href="{{ asset('bower_components/bower_FTMS/css/style-main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/preloader.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/bower_FTMS/js/revolution-slider/css/settings.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_FTMS/js/revolution-slider/css/layers.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_FTMS/js/revolution-slider/css/navigation.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_FTMS/css/colors/theme-skin-color-set-1.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('bower_components/bower_FTMS/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
</head>
<body class="">
    <div id="wrapper" class="clearfix">
        @include('client.layouts.header')
        <div class="main-content">
            @yield('content')
        </div>
        @include('client.layouts.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/bower_FTMS/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_FTMS/js/revolution-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
</body>
</html>
