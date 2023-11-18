<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Cebu Business Months</title>

  <!-- Favicons -->
  <link href="/images/main/cbm.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/aos/aos.css" rel="stylesheet">
  <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/style/main/style.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="/images/main/cbm.png" alt="company logo">
      </a>

      <div class="d-flex align-items-center">
        <nav id="navbar" class="navbar">
          <ul>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('landing-events') }}">Events</a></li>
          </ul>
        </nav><!-- .navbar -->

        <a class="btn-book-a-table" href="{{ route('landing-events') }}">Buy Now</a>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      </div>
    </div>
  </header><!-- End Header -->

  <main id="main">
    @yield('content')
  </main>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="row gy-3">
        <div class="col-6">
          <div class="row">
            <img src="/images/main/cbm.png" style="width: 200px;">
            <img src="/images/main/cebu-logo.JPG" style="width: 200px;">
          </div>
          <p class="fw-bold mt-3">2023 Cebu Business Month. All rights reserved</p>
        </div>

        <div class="col-6 footer-links-container">
          <div class="row">
            <div class="col-6">
              <a href="#">Back to Top</a>
            </div>
            <div class="col-6">
              <a href="#">Contact Us</a>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <a href="#">About</a>
            </div>
            <div class="col-6">
              <a href="#">Privacy Policy</a>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <a href="{{ route('landing-events') }}">Events</a>
            </div>
            <div class="col-6">
              <a href="#">Terms of Service</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/aos/aos.js"></script>
  <script src="/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/script/main/script.js"></script>
</body>

</html>
