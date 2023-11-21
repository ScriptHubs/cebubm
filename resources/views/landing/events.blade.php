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
          <a href={{ route('landing-events') }} class="btn-buy-tickets">BUY TICKETS</a>
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

  <!-- ======= Events Section ======= -->
  <section id="events" class="events">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <p class="fw-bold">UPCOMING EVENTS</p>
      </div>
      <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 1">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 2">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 3">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 4">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 5">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 7">
          <img class="swiper-slide event-item" src="/images/main/ticket.JPG" alt="Event Image 8">
        </div>
        <div class="swiper-pagination"></div>
        <!-- Add navigation arrows -->
        <div class="swiper-button-next ps-5"></div>
        <div class="swiper-button-prev pe-5"></div>
      </div>
    </div>
  </section>
  <!-- End Events Section -->

  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <p class="fw-bold">PREVIOUS EVENTS</p>
      </div>

      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery" href="/images/main/events/event-1.jpg"><img
                src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery" href="/images/main/events/event-2.jpg"><img
                src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery" href="/images/main/events/event-3.jpg"><img
                src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery"
              href="/images/main/events/event-1.jpg"><img src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery"
              href="/images/main/events/event-2.jpg"><img src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery"
              href="/images/main/events/event-3.jpg"><img src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery"
              href="/images/main/events/event-1.jpg"><img src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
            </div>
          </div>
          <div class="swiper-slide rounded"><a class="glightbox" data-gallery="images-gallery"
              href="/images/main/events/event-2.jpg"><img src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt=""></a>
            <div class="gallery-caption">
              <h3>Event 1</h3>
              <p>Description for Event 1.</p>
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
