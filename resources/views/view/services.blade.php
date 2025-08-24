@extends('layouts.main')

@section('content')

<main>
    <div class="content-wrapper">
      <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px">
          <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
            Services
          </h4>
          <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item "><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-light">Services</li>
          </ol>
        </div>
      </div>

      <div class="container">
        <section class="prop-service__section banner-section">
          <div class="prop-service__banner">
            <span class="svg-ico banner-oval-yellow mt-5">
              <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 535 445">
                <defs>
                  <style>
                    .cls-3 {
                      fill: #fcb900;
                    }
                  </style>
                </defs>
                <path class="cls-3"
                  d="M108.87,71.12C277.86,42.67,297.51-51.48,372,37.23,404.49,76,522.52,149,534,201c14.78,66.93-147,126.24-197,168.2-88.85,74.55-206,105.42-270.38,36.9s-126.74-306.52,42.25-335Z" />
              </svg>
            </span>
            <span class="svg-ico banner-oval-blue">
              <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 616 240">
                <defs>
                  <style>
                    .cls-2 {
                      fill: #99fcff71;
                    }
                  </style>
                </defs>
                <g class="cls-1">
                  <path class="cls-2"
                    d="M616,1V382L458,540a100,100,0,0,1-141.42,0L29.48,252.93a100,100,0,0,1,0-141.42L140,1Z" />
                </g>
              </svg>
            </span>
            <div class="prop-service__banner--graphic">
              <img id="service-image"
                src="https://cdn.staticmb.com/propertyservicestatic/marketplacestatic/images/prop-service-home/banner/v3/home-loans.png"
                alt="Service Graphic">
            </div>

            <div class="prop-service__banner__column">
              <div class="prop-service__banner__title">

                <div class="prop-service__banner__title--text1">
                  <h1>CPR Pyropark </h1>
                </div>

              </div>

              <ul class="prop-service__banner__list" id="services-list">
                @if(isset($services))
                @php
                    $i=0;
                @endphp
                @foreach ($services as $service)
                <li class="prop-service__banner__list--item">
                    <a data-image="{{ asset($service->image) }}" class="service-link">
                        <i class="{{ $service->icon }}"></i>{{ $service->title }}</a>
                  </li>                
                @php
                    $i++;
                @endphp
                @endforeach
                @endif
              </ul>
            </div>
          </div>
        </section>
      </div>


      <div class="container-fluid px-0">
        <div class="swiper-container sliderTab">
          <div class="swiper-wrapper">
            @if(isset($services))
            @php
                $i=0;
            @endphp
            @foreach ($services as $service)
            <div class="swiper-slide {{ $i==0?'on':'' }}"><a><span class="text">{{ $service->title }}</span></a></div>
            @php
                $i++;
            @endphp
            @endforeach
            @endif
            {{-- <div class="swiper-slide"><a><span class="text">Property Legal Services</span></a></div>
            <div class="swiper-slide"><a><span class="text">Housing Loans for Property</span></a></div>
            <div class="swiper-slide"><a><span class="text">Documentation and Registration</span></a></div>
            <div class="swiper-slide"><a><span class="text">NRI Property Services</span></a></div>
            <div class="swiper-slide"><a><span class="text">Investment in Projects</span></a></div> --}}
          </div>
        </div>
        <hr>


        <div class=" container swiper-container sliderContent my-5">
          <div class="swiper-wrapper">
            @if(isset($services))
            @php
                $i=0;
            @endphp
            @foreach ($services as $service)
            <div class="swiper-slide">
                <div class="">
                  <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 service-toggle-image" >
                      <img src="{{ asset($service->image) }}" class=" rounded" alt="Identification of Property">
                    </div>
                    <div class="col-lg-6">
                      <div class="content-side">
                        <h2 class="mb-4">{{ $service->title }}</h2>
                        <p class="content-side-para">
                            {!! $service->description !!}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @php
                $i++;
            @endphp
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const serviceLinks = document.querySelectorAll(".service-link");
      const serviceImage = document.getElementById("service-image");

      serviceLinks.forEach(link => {
        // Hover to change the image
        link.addEventListener("mouseover", function () {
          const newImage = this.getAttribute("data-image");
          serviceImage.setAttribute("src", newImage);
        });

        // Click to redirect and highlight active link
        link.addEventListener("click", function () {
          serviceLinks.forEach(link => link.classList.remove("active"));
          this.classList.add("active");

          // Redirect to the link's href
          window.location.href = this.href;
        });
      });
    });
    document.addEventListener("DOMContentLoaded", function () {
      var swiperTab = new Swiper(".sliderTab", {
        slidesPerView: "auto",
        preventClicks: true,
        preventClicksPropagation: false,
        observer: true,
        observeParents: true,
        freeMode: true,
        watchSlidesProgress: true
      });

      var swiperContent = new Swiper(".sliderContent", {
        slidesPerView: 1,
        spaceBetween: 30,
        autoHeight: true,
        allowTouchMove: false,
        thumbs: {
          swiper: swiperTab
        }
      });

      var $snbSwiperItem = $(".sliderTab .swiper-wrapper .swiper-slide a");
      $snbSwiperItem.click(function () {
        var target = $(this).parent();
        $snbSwiperItem.parent().removeClass("on");
        target.addClass("on");
        muCenter(target);
      });

      function muCenter(target) {
        var snbwrap = $(".sliderTab .swiper-wrapper");
        var targetPos = target.position();
        var box = $(".sliderTab");
        var boxHarf = box.width() / 2;
        var pos;
        var listWidth = 0;

        snbwrap.find(".swiper-slide").each(function () {
          listWidth += $(this).outerWidth();
        });

        var selectTargetPos = targetPos.left + target.outerWidth() / 2;
        if (selectTargetPos <= boxHarf) {
          pos = 0;
        } else if (listWidth - selectTargetPos <= boxHarf) {
          pos = listWidth - box.width();
        } else {
          pos = selectTargetPos - boxHarf;
        }

        setTimeout(function () {
          snbwrap.css({
            transform: "translate3d(" + pos * -1 + "px, 0, 0)",
            "transition-duration": "250ms"
          });
        }, 100);
      }

      // Adjust tab visibility on window resize
      window.addEventListener('resize', function () {
        swiperTab.update();
        swiperContent.update();
      });
    });
  </script>
@endsection