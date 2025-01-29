<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=0.9" name="viewport">

  <title>@yield('title', 'Page') - BW APPS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <!-- PWA  -->
    <meta name="theme-color" content="#2F2F6F"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

  <!-- Favicons -->
  <link href="{{ asset('logo.png') }}" rel="icon">
  <link href="{{ asset('logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('templates/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('templates/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  @yield('style')

  <!-- Template Main CSS File -->
  <link href="{{ asset('templates/assets/css/style.css') }}" rel="stylesheet">
    <style>
    .pageLoader{
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9999999;
        background-color: #ffffff8c;

    }
    .loader {
        border: 8px solid #f3f3f3; /* Light grey */
        border-top: 8px solid #ffce6d; /* Blue */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 0.5s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>

  <!-- =======================================================
  * Template Name: Nicetemplates
  * Template URL: https://bootstrapmade.com/nice-templates-bootstrap-templates-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <div  class="pageLoader" id="pageLoader">
        <div class="d-flex align-items-center justify-content-center h-100 w-100">
            <div class="loader"></div>
        </div>
    </div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.dashboard.index') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('logo.png') }}" alt="">
        <span class="d-none d-lg-block">Sikribo</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ route('admin.users.detail', ['id' => Auth::user()->id]) }}" data-bs-toggle="dropdown">
            <img src="{{ asset('user_profile.png') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>
                @foreach (Auth::user()->roles as $role)
                    {{ $role->name }},
                @endforeach
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.detail', ['id' => Auth::user()->id]) }}">
                <i class="bi bi-person"></i>
                <span>Kelola Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
            <li>
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </li>
            </form>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    @include('admin.templates.components.menu')

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>@yield('title')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Library</a></li>
          <li class="breadcrumb-item active">Default</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @yield('user-profile')
    <section class="section">
        @if (count($errors) > 0)
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            <strong>Gagal</strong>Update Data.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Bank Wonosobo</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
            console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
            console.error(`Service worker registration failed: ${error}`);
        },
        );
    } else {
        console.error("Service workers are not supported.");
    }
    </script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('templates/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('templates/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('templates/assets/js/main.js') }}"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(window).on('beforeunload', function(){

            $('#pageLoader').show();

        });

        $(function () {

            $('#pageLoader').hide();
        })
    </script>

  @yield('script')
</body>

</html>
