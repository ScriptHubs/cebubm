@extends('layouts.app')

@section('content')
  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery section-bg mt-3">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <p class="fw-bold">GALLERY</p>
      </div>

      <div class="row gallery-grid">
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 1) }}">
              <img src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 2) }}">
              <img src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 3) }}">
              <img src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 4) }}">
              <img src="/images/main/events/event-4.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 5) }}">
              <img src="/images/main/events/event-5.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 4) }}">
              <img src="/images/main/events/event-4.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 3) }}">
              <img src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 2) }}">
              <img src="/images/main/events/event-2.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 3) }}">
              <img src="/images/main/events/event-3.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 4) }}">
              <img src="/images/main/events/event-4.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 5) }}">
              <img src="/images/main/events/event-5.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
          <div class="gallery-item rounded">
            <a href="{{ route('gallery-images', 1) }}">
              <img src="/images/main/events/event-1.jpg" class="img-fluid rounded" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Gallery Section -->
@endsection
