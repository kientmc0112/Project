<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title') | {{ trans('setting.project') }}</title>
  {{-- <link href="{{ asset('bower_components/fontawesome/css/brands.css') }}"  --}}
  <!-- Custom fonts for this template-->
  <link href="{{ asset('bower_components/assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('bower_components/assets/admin/css/sb-admin.css') }}" rel="stylesheet">
  {{-- Datatable --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatable/DataTables/datatables.min.css') }}"/>
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


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('bower_components/assets/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('bower_components/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('bower_components/assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('bower_components/assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('bower_components/assets/admin/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('bower_components/assets/admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('bower_components/assets/admin/js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('bower_components/assets/admin/js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('bower_components/assets/admin/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/datatable/DataTables/datatables.min.js') }}"></script>
  <script src="{{ asset('bower_components/assets-client/js/custom.js') }}"></script>

</body>

</html>
