@extends('layouts.app')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center position-relative">
    <div class="container-fluid px-0">
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
      <div class="text-content position-absolute translate-middle-y text-left ps-5 carousel-header" style="top:46%">
        <h2>Take Your Business To<br>
          New Heights And Join The<br> Industry Leaders</h2>
        <div class="d-flex">
          <a href="#about" class="btn-events">EVENTS</a>
        </div>
      </div>

      <!-- Carousel Indicators -->
      <div id="heroCarouselIndicators" class="carousel-indicators d-flex justify-content-start px-4">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active me-2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" class="me-2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" class=""></button>
      </div>

    </div>
  </section><!-- End Hero Section -->


  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4 justify-content-center">
        <div class="col-6 col-lg-4 position-relative about-img" data-aos="fade-up" data-aos-delay="150">
          @if (isset($event) && isset($event->poster))
            <img src="{{ asset('storage/' . $event->poster) }}" class="w-75" alt="{{ $event->event_name }} Poster">
          @endif
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
          <div class="content ps-0 ps-lg-5">
            <div>
              @if (isset($event))
                <h1>{{ $event->event_name }}</h1>
                <p class="small">
                  <span class="badge bg-primary-blue">
                    @if ($event->event_date_from == $event->event_date_to)
                      {{ date('F j, Y', strtotime($event->event_date_from)) }}
                    @else
                      {{ date('F j, Y', strtotime($event->event_date_from)) }}
                      - {{ date('F j, Y', strtotime($event->event_date_to)) }}
                    @endif
                  </span>
                </p>

                <br>
                <h5>
                  {{ $event->event_description }}
                </h5>
                <br>
                <h4>
                  Get your tickets here!
                </h4>
                <h4>
                  <a href="{{ route('register-event', $event->id) }}" class="btn btn-primary-blue">Buy Now</a>
                </h4>
              @else
                <h1>No upcoming events</h1>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End About Section -->

  <!-- ======= Events Section ======= -->
  <section id="events" class="events">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <p class="fw-bold">UPCOMING EVENTS</p>
      </div>
      <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 1">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 2">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 3">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 4">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 5">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 7">
          <img class="swiper-slide event-item" src="/images/main/events/ticket.jpg" alt="Event Image 8">
        </div>
        <div class="swiper-pagination"></div>

        <!-- Add navigation arrows -->
        <div class="swiper-button-next ps-5"></div>
        <div class="swiper-button-prev pe-5"></div>
      </div>
    </div>
  </section>
  <!-- End Events Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4">
        <div class="col-6 col-lg-2 position-relative about-img" data-aos="fade-up" data-aos-delay="150">
          <img src="/images/main/logos/cbm.png" class="img-fluid rounded" alt="CBM Image">
        </div>
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="300">
          <div class="content ps-0 ps-lg-5">
            <h1 class="header-title">THE CBM</h1>
            <br>
            <h5>
              <span class="fw-bold">The CEBU BUSINESS MOBILIZATION (CBM)</span> focuses on the needs of its members in
              the Cebu business community for opportunities that promote and enable innovation, entrepreneurship,
              creativity and digital transformation towards resilience and global competitiveness.
            </h5>
            <h5>
              It fosters interrelationships within the board of trustees, sectoral associations, CCCI MEMBERS, and private
              & public entities; thus, engaging key players and champions to craft & mobilize towards the implementation
              of relevant activities, projects, and programs such as the Cebu Business Month under the leadership of the
              CBM Chair.
            </h5>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End About Section -->
@endsection
