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
    <!-- Custom fonts for this template-->
    <link href="{{ asset('bower_components/assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.css') }}"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('bower_components/assets/admin/css/sb-admin.css') }}" rel="stylesheet">
    {{-- Datatable --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/datatable/DataTables/datatables.min.css') }}" />
        <script src="{{ asset('bower_components/assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
    
</head>

<body id="page-top">
    <!-- header -->
    @include('admin.layouts.header')
    <!-- end header -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- end sidebar -->
        <div id="content-wrapper">
            <!-- content -->
            @yield('content')
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>{{ trans('setting.sticky_footer') }}</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
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
    <script type="text/javascript" src="{{ asset('bower_components/datatable/DataTables/datatables.min.js') }}">
    </script>
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
                    labels: [" Month 1", " Month 2", " Month 3", " Month 4", " Month 5", " Month 6", " Month 7", " Month 8", " Month 9", " Month 10", " Month 11", " Month 12"],
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
                    hover: {mode: null},
                    tooltips: {enabled: false},
                }
            });
        });
    </script>
</body>

</html>
