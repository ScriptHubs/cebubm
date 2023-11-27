@extends('layouts.app')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center position-relative">
    <div class="container-fluid  px-0">
      <!-- Carousel Items -->
      <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/images/main/events/event-1.jpg" class="d-block w-100" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="/images/main/events/event-2.jpg" class="d-block w-100" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="/images/main/events/event-3.jpg" class="d-block w-100" alt="Slide 3">
          </div>
        </div>
      </div>

      <!-- Text Content -->
      <div class="text-content position-absolute translate-middle-y text-left ps-5 carousel-header-event">
        <div class="d-flex">
          <a href="{{ route('register-event') }}" class="btn-buy-tickets">BUY TICKETS</a>
        </div>
      </div>

      <!-- Carousel Indicators -->
      <div id="heroCarouselIndicators"
        class="carousel-indicators carousel-indicators-events d-flex justify-content-start px-4">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active me-2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" class="me-2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" class=""></button>
      </div>

    </div>
  </section><!-- End Hero Section -->

  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <p class="fw-bold">GALLERY</p>
      </div>

      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 1) }}"><img
                src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 2) }}"><img
                src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 2</h3>
              <p>Description for Event 2.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 3) }}"><img
                src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 3</h3>
              <p>Description for Event 3.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 4) }}"><img
                src="/images/main/events/event-4.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 4</h3>
              <p>Description for Event 4.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 5) }}"><img
                src="/images/main/events/event-5.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 5</h3>
              <p>Description for Event 5.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 6) }}"><img
                src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 6</h3>
              <p>Description for Event 6.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 7) }}"><img
                src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 7</h3>
              <p>Description for Event 7.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a href="{{ route('gallery-images', 8) }}"><img
                src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 8</h3>
              <p>Description for Event 8.</p>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <!-- Add navigation arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>
  <!-- End Gallery Section -->
@endsection
