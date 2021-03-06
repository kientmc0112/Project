<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ trans('setting.project') }}</title>
    {{-- <link href="{{ asset('bower_components/fontawesome/css/brands.css') }}" --}}
    <link href="{{ asset('bower_components/assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/assets/admin/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatable/DataTables/datatables.min.css') }}" />
    <script src="{{ asset('bower_components/assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
</head>

<body id="page-top">
    @include('admin.layouts.header')
    <div id="wrapper">
        @include('admin.layouts.sidebar')
        <div id="content-wrapper">
            @yield('content')
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>{{ trans('setting.sticky_footer') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
            
    <script src="{{ asset('bower_components/assets/admin/js/sb-admin.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('bower_components/assets/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/datatable/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('bower_components/assets-client/js/custom.js') }}"></script>
    <script text="text/javascript">
        $(document).ready(function () {
            var count = $("#count_chart").val();
            count = JSON.parse(count);
            Chart.defaults.global.defaultFontFamily =
                '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Sessions",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: count,
                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                }
            });
            $('#year_chart').on('change', function(){
                $('#form_chart').submit();
            })
        });
    </script>
</body>

</html>
