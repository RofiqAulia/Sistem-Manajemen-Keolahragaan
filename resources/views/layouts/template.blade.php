<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') . ' | Dashboard' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('/vendor/landing/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('/vendor/landing/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @stack('css')
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
      @include('layouts.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/logoukmor.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">UKM Olah Raga</span>
      </a>

      <!-- Sidebar -->
          @include('layouts.sidebar')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding-bottom: 60px">
      <!-- Content Header (Page header) -->
      @include('layouts.breadcrumb')

      <!-- Main content -->
      <section class="content">
          @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  <br><br><br>
    @include('layouts.footer')
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('vendor/adminlte/jquery/jquery.min.js') }}"></script>
  {{-- Chart.js --}}
  <script src="{{ asset('vendor/adminlte/chart.js/Chart.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- Datatables & -->
  <script src="{{ asset('vendor/adminlte/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendor/adminlte/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

  <script>
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  </script>
  @stack('js')

  </body>
</html>