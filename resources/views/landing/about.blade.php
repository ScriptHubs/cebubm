@extends('layouts.app')

@section('content')
  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4 justify-content-center">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="content">
            <div class="text-center">
              <br>
              <img src="/images/main/logos/cbm.png" class="rounded">
              <h1 class="header-title">
                CBM
              </h1>
              <h5>
                The CEBU BUSINESS MOBILIZATION (CBM) focuses on the needs of its members in the Cebu
                business community for opportunities that promote and enable innovation,
                entrepreneurship, creativity and digital transformation towards resilience and global
                competitiveness.
              </h5>
            </div>
            <br>
            <br>
          </div>
        </div>
        <div class="col-lg-4 position-relative about-img" data-aos="fade-up" data-aos-delay="150">
          <img src="/images/main/events/event-4.jpg" class="w-100 rounded" style="height: 500px;">
        </div>
      </div>
      <div class="row gy-4 justify-content-center mt-3">
        <div class="col-lg-4 position-relative about-img" data-aos="fade-up" data-aos-delay="150">
          <img src="/images/main/events/event-5.jpg" class="w-100 rounded" style="height: 500px;">
        </div>
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
          <div class="content ps-0 ps-lg-5">
            <div class="text-center">
              <br>
              <img src="/images/main/logos/logo-2.jpg" class="rounded">
              <h1 class="header-title">
                CCCI
              </h1>
              <h5>
                The Cebu Chamber of Commerce & Industry (CCCI) is the largest and a prominent local
                business membership organization in the Philippines. With over 900 member companies
                coming from various sectors such as Trade, Industry, Service, ICT and Sectoral
                Business Associations, CCCI envisions itself as “The Engine of Cebu’s Business
                Growth towards Global Competitiveness”
              </h5>
            </div>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End About Section -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <div class="slides-vision-mission swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <div class="swiper-slide event-item">
              <div class="section-header">
                <div class="d-flex justify-content-center">
                  <img src="/images/main/vision.jpg" style="width: 70px; height: 50px;" class="mt-1">
                  <p class="fw-bold px-3">Our Vision</p>
                </div>
              </div>
              <div class="col-lg-8 mx-auto">
                <h5>
                  Our vision is to be the leading catalyst for growth and transformation in the Cebu business
                  community. We envision a future where our members thrive in an environment that embraces
                  innovation, entrepreneurship, creativity, and digital transformation. By fostering a culture of
                  resilience and global competitiveness, we aim to position Cebu as a hub for cutting-edge
                  technologies, groundbreaking ideas, and sustainable business practices. Our ultimate goal is to
                  empower our members to drive economic prosperity, create job opportunities, and contribute to
                  the overall development of Cebu, making it a vibrant and globally recognized business
                  destination.
                </h5>
              </div>
            </div>
            <div class="swiper-slide event-item">
              <div class="section-header">
                <div class="d-flex justify-content-center">
                  <img src="/images/main/mission.jpg" style="width: 50px; height: 50px;" class="mt-2">
                  <p class="fw-bold px-3">Our Mission</p>
                </div>
              </div>
              <div class="col-lg-8 mx-auto">
                <h5>
                  Our mission is to meet the needs of our members in the Cebu business community by providing
                  opportunities that promote and enable innovation, entrepreneurship, creativity, and digital
                  transformation. We strive to enhance resilience and global competitiveness among our members, driving
                  their growth and success through collaboration, networking, and knowledge sharing. As advocates for
                  business innovation and sustainability, we aim to be a driving force in Cebu's economic development.
                </h5>
              </div>
            </div>
          </div>
          <!-- Add navigation arrows -->
          <div class="swiper-button-next ps-5"></div>
          <div class="swiper-button-prev pe-5"></div>
        </div>
      </div>
  </section>
  <!-- End About Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <p class="fw-bold">UPCOMING EVENTS</p>
      </div>
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
                  <span class="badge bg-primary-blue">{{ date('F j, Y', strtotime($event->event_date_from)) }}
                    - {{ date('F j, Y', strtotime($event->event_date_to)) }}</span>
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
@endsection
