@extends('layouts.main')

@section('content')
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* Ensure the container takes up 100% width */
.container24 {
  max-width: 100%;
}

/* Styling for the Swiper container */
.swiper2 {
  margin: 0 auto; /* Center the Swiper */
  width: 100%; /* Make it responsive */
  height: 100%; /* Adjust height as needed */
}

/* Styling for individual slides */
.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  font-weight: bold;
  color: #fff;
  height: 100%; /* Ensure slides fill the height of the container */
}

.swiper2 .swiper-wrapper .swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: fill;
}
.swiper2 .swiper-wrapper .swiper-slide img:hover {
  transition: filter 0.3s ease; /* Smooth transition for blur effect */
}

.swiper-slide:hover .ad-carousel-image {
  filter: blur(5px); /* Apply blur effect when the slide is hovered */
}
.view-property-btn-container {
  position: absolute;
  bottom: 40%; /* Position it at the bottom of the slide */
  left: 50%;
  transform: translateX(-50%);
  opacity: 0; /* Initially hide the button */
  transition: opacity 0.3s ease; /* Smooth transition for visibility */
}
.view-property-btn {
  color: #fff; /* Button text color */
  font-weight: bold;
  text-transform: uppercase;
  text-decoration: none;
  padding: 10px 20px;
  background-color: #004AAD; /* Button background color */
  border-radius: 3px;
  border: 1px solid #004AAD;
  position: relative; /* Needed for positioning the arrow */
  overflow: hidden; /* Ensures the arrow stays inside the button */
  display: inline-block;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.view-property-btn::after {
  content: '→'; /* Unicode arrow character */
  font-size: 20px;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.view-property-btn:hover {
  background-color: #012d66; /* Darker background color on hover */
  color: #fff;
  border: 1px solid #004AAD;
  transform: scale(1.05); /* Slight scale effect on hover */
}

.view-property-btn:hover::after {
  opacity: 1;
  transform: translateY(-50%) translateX(10px); /* Arrow slides to the right */
}

.swiper-slide:hover .view-property-btn-container {
  opacity: 1; 
}
   .carousel-item {
     position: relative;
     height: 90vh;
     background-size: cover;
     /* width: 100vh; */
     z-index: 1000;
 }
 .custom-prev-btn,
  .custom-next-btn {
    position: absolute;
    top: 50%;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
  }

  .custom-prev-btn {
    left: 10px;
    transform: translateY(-50%);
  }

  .custom-next-btn {
    right: 10px;
    transform: translateY(-50%);
  }
  .know-more-btn{
      color:#004AAD;
      font-size:17px;
  }
  .know-more-btn:hover{
      color:#0d6efd;
  }
  /* From Uiverse.io by gharsh11032000 */ 
.card {
    position: relative;
    width: 419px;
    height: 250px;
    border-radius: 10px;
    border:none;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}
/*.card-section{*/
/*    gap:5px;*/
/*}*/
.service-card-img-left {
    width: 100%;
    height: 250px;
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}
.card svg {
  width: 48px;
  fill: #333;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.card:hover {
  transform: rotate(-5deg) scale(1.1);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.card__content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
  width: 100%;
  height: 100%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #fff;
  opacity: 0;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.card:hover .card__content {
  transform: translate(-50%, -50%) rotate(0deg);
  opacity: 1;
}

.card__title {
  margin: 0;
  font-size: 24px;
  color: #333;
  font-weight: 700;
}

.card__description {
  margin: 10px 0 0;
  font-size: 14px;
  color: #777;
  line-height: 1.4;
}
.card__title a {
  margin: 0;
  font-size: 24px;
  color: #004AAD;
  font-weight: 700;
}

.card__content p a {
  margin: 10px 0 0;
  font-size: 14px;
  color: #004AAD !important;
  line-height: 1.4;
}
.card__content p a:hover {
  color: #006eff !important;
}

.card:hover svg {
  scale: 0;
  transform: rotate(-45deg);
}
.newly-launched-products {
  padding: 2rem;
  /* background: #f9f9f9; */
  position: relative;
  border-radius: 10px;
  margin-left:26px;
  /*margin: 5px 5px 5px 0px ;*/
  max-width: 100%;
  /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
  overflow: hidden;
} 
.home-section-title {
    color: var(--blue);
    font-weight: 600;
    font-size: 25px ! important;
}
.swiper-button-next {
    top: 57% !important;
    right: 0% !important;
}
.swiper-button-prev {
    top: 57% !important;
    left: 0% !important;
}
/* Style for the next button */
.swiper-button-next {
  position: absolute;
  top: 50%;
  right: 10px; /* Adjust distance from the edge */
  transform: translateY(-50%);
  width: 40px !important;
  height: 40px !important;
  background-color: #284aad; /* Button background color */
  border-radius: 50%; /* Makes it circular */
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow */
  z-index: 10;
  cursor: pointer;
  transition: transform 0.3s ease, background-color 0.3s ease;
}

.swiper-button-next::after {
  content: '➤'; /* Unicode arrow character */
  color: #fff; /* Arrow color */
  font-size: 20px !important;
}

/* Style for the previous button */
.swiper-button-prev {
  position: absolute;
  top: 50%;
  left: 10px; /* Adjust distance from the edge */
  transform: translateY(-50%);
  width: 40px !important;
  height: 40px !important;
  background-color: #284aad; /* Button background color */
  border-radius: 50%; /* Makes it circular */
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow */
  z-index: 10;
  cursor: pointer;
  transition: transform 0.3s ease, background-color 0.3s ease;
}

.swiper-button-prev::after {
  content: '⬅'; /* Unicode arrow character */
  color: #fff; /* Arrow color */
  font-size: 20px !important;
}

/* Hover effect for buttons */
.swiper-button-next:hover, 
.swiper-button-prev:hover {
  background-color: #1c3a87; /* Darker background on hover */
  transform: scale(1.1); /* Slight zoom effect */
}

.scroll-container {
  display: flex;
  overflow-x: auto; /* Enable horizontal scrolling */
  gap: 20px; /* Spacing between items */
  padding: 15px;
  scroll-behavior: smooth; /* Smooth scrolling for a better experience */
  -webkit-overflow-scrolling: touch; /* Better scroll behavior on touch devices */
}

/* Optional: Style for each product */
.product {
  flex-shrink: 0; /* Prevent shrinking of items */
  width: 300px; /* Set fixed width for consistency */
  scroll-snap-align: start; /* Ensure smooth snapping */
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
/* Optional: Hide overflow to prevent scrollbars */
.scroll-container::-webkit-scrollbar {
  display: none;
}

/* Optional: Smooth scrolling for better user experience */
.scroll-container {
  scroll-behavior: smooth;
}


.product.visible {
  opacity: 1;
  transform: translateY(0);
}

.product:hover {
  /* transform: translateY(-10px); */
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Media Section */
.product-media {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

/* Product Content */
.product-content {
  padding: 1rem;
  text-align: center;
}

.product-title {
    font-size: 1.2rem;
    color: #284aad;
    font-weight: 700;
}
.nlp-tag2, .nlp-rera {
    position: absolute;
    top: 10px;
    left: 0;
    width: 120px;
    height: 24px;
    text-align: center;
    font-weight: 800;
    line-height: 24px;
    text-transform: uppercase;
    font-size: 0.85rem;
    color: #000000;
    /* padding: 0.4rem 1rem; */
    background-color: #ffffff;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.nlp-tag2:before{
  display: none;
}
.nlp-tag2:after{
display: none;
}
.nlp-tag2:hover, .nlp-rera:hover {
  transform: scale(1.05);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
}

.nlp-rera {
  background-color: #28a745; /* Green for RERA */
}
@media (min-width: 1400px) {
    .container{
        max-width: 100%;
    }
}

@media (max-width: 1024px) {
  .service-card2 {
 width: 320px;
    
}
  }
/* Responsive Design */
@media (max-width: 768px) {
  .scroll-container {
    gap: 0.5rem;
  }
  .card {
 width: 354px;
    
}
  .product {
    flex: 0 0 250px;
  }
}
@media (max-width: 425px) {
   .service-card2 {
 width: 376px;
    
}
.newly-launched-products{
    overflow: hidden;
}
  }
  @media (max-width: 375px) {
   .service-card2{
 width: 326px;
    
}
@media (max-width: 320px) {
     .service-card2 {
 width: 290px;
    
}
.property-page-form {
  
    margin: 0 -31px;
}
.rc-anchor-normal {
    height: 74px;
    width: 235px !important;
}
    
}
  
.swiper-container {
  width: 100%;
  overflow-x: hidden;
  padding: 15px 0;
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
  width: auto; /* Let Swiper handle slide widths */
}

.swiper-button-next, .swiper-button-prev {
  color: #000; /* Customize navigation buttons */
}

.swiper-pagination-bullet {
  background-color: #000; /* Customize pagination bullets */
}
</style>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="{{ asset('/assets/js/index.js') }}"></script>
<div class="container24">
  <div class="row">
    <div class="col-12 pe-0">
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @if(isset($sliders) && $sliders->count())
            @foreach ($sliders as $key => $slider)
              <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ asset('images/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}" />
                <div class="home-slider-overlay">
                     <span class="home-overlay-text">
                        <h1 class="fst-italic">{{ $slider->title }}</h1>
                      </span>
                  <!--<div class="slider-outer-circle">-->
                  <!--  <div class="slider-inner-circle">-->
                     
                  <!--  </div>-->
                  <!--</div>-->
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        <button class="custom-prev-btn" onclick="moveCarousel(-1)">Previous</button>
        <button class="custom-next-btn" onclick="moveCarousel(1)">Next</button>
      </div>
    </div>
    <!--<div class="col-3 ps-0">-->
    <!--  <div class="swiper2 mySwiper24 ps-0 mb-0">-->
    <!--    <div class="swiper-wrapper">-->
    <!--      @if (isset($advertisements))-->
    <!--        @foreach ($advertisements as $advertisement)-->
    <!--          <div class="swiper-slide">-->
    <!--            <img src="{{ asset($advertisement->ad_image) }}" alt="Advertisement Image" class="ad-carousel-image image-1" />-->
    <!--            <div class="view-property-btn-container">-->
    <!--              <a href="{{ route('property-view', ['slug' => \Hashids::encode($advertisement->property_id), 'name' => Str::slug($advertisement->property->title)]) }}" -->
    <!--                 class="btn btn-primary view-property-btn" -->
    <!--                 target="_blank" -->
    <!--                 rel="noopener noreferrer">-->
    <!--                 View-->
    <!--              </a>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        @endforeach-->
    <!--      @endif-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    
  </div>
</div>


  {{-- <div class="services-section">
    <div class="container-xxl py-5">
      <div class="container">
        <div class="services-heading ">
          <div class="mb-5">
            <h2 class="home-section-title half-underline mb-0">Services Offered</h2>
            <div class="d-flex justify-content-between">
              <p class="services-section-subtitle mt-2">Properties Identification to Occupation</p>
              <a class="mt-4 know-more-btn" href="{{ route('services') }}">Know More>></a>
            </div>
          </div>



        </div>

        <!-- Cards Section -->
        <div class="row g-4">
          @if(isset($services))
    
          @foreach ($services as $service)
          <div class="col-lg-6 col-md-6">
            <div class="home-service-item d-flex align-items-center h-100">
              <img src="{{ asset($service->image) }}" alt=" Legal Property Requirements Image "
                class="service-card-img-left">
              <div class="service-text p-4">
                <h5 class="service-card-title">{{ $service->title }}</h5>
                <p class="service-card-para">{!! Str::limit($service->description, 100)!!}</p>

              </div>
            </div>
          </div>
     
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div> --}}

  <div class="services-section">
    <div class="container-xxl py-5">
      <div class="">
        <!-- Section Title -->
        <div class="services-heading ">
          <div class="mb-5">
            <h2 class="home-section-title half-underline mb-0">Services Offered</h2>
            <div class="d-flex justify-content-between">
              <p class="services-section-subtitle mt-2">Properties Identification to Occupation</p>
              <a class="mt-4 know-more-btn" href="{{ route('services') }}">Know More>></a>
            </div>
          </div>



        </div>

        <!-- Cards Section -->
        <div class="row g-4 card-section">
          @if(isset($services))
          @foreach ($services as $service)
          <div class="col-lg-4 col-md-6">
            <div class="card service-card2">
              <img src="{{ asset($service->image) }}" alt=" Legal Property Requirements Image "
                class="service-card-img-left">
              <div class="card__content">
                <p class="card__title"><a href="{{ route('services') }}">{{ $service->title }}</a>
                </p><p class="card__description"><a href="{{ route('services') }}">{!! Str::limit($service->description, 222)!!}</a></p>
              </div>
            </div>
          </div>
     
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>



  <section class="newly-launched-section">
    <div class="container nlp-container">
      <div class="nlp-header d-flex justify-content-between">
        <div class="nlp-icon">
          <div class="d-flex">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 21H21" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M5 21V7L13 3V21" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M19 21V11L13 7" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M9 9V9.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M9 13V13.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M9 17V17.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            <h1 class="home-section-title half-underline">Featured Properties</h1>
          </div>
          <p class="services-section-subtitle slide-in-text">Less upfront payment</p>
        </div>
        <div>
            <!--<a class="mt-4 know-more-btn" href="{{ route('services') }}">Know More>></a>-->
        </div>
      </div>

      <div class="new-projects-container">
        <button class="nlp-scroll-btn prev" onclick="scrollProjects(-1)">
          &#10094;
        </button>
        <div class="new-projects-container" bis_skin_checked="1">
          <button class="nlp-scroll-btn prev" onclick="scrollProjects(-1)" style="display: flex;">
            ❮
          </button>
          <div class="new-projects-scroll" id="projectScroll" bis_skin_checked="1">
            @if (isset($futuredProperties))
            @foreach ($futuredProperties as $propertyList)
            @php
                $storedImages = json_decode($propertyList->images, true);
                $storedVideos = json_decode($propertyList->videos, true);
            @endphp
            <div class="property-card">
                <div class="col-lg-4">
                    <div class="nlp-card d-flex">
                        <div class="nlp-card-img">
                            {{-- Dynamic Media Logic --}}
                            @if (!empty($storedVideos)) 
                                {{-- Display the first video --}}
                                @php
                                    $firstVideo = $storedVideos[0];
                                @endphp
                                @if (filter_var($firstVideo, FILTER_VALIDATE_URL))
                                    @php
                                        $videoId = '';
                                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/', $firstVideo, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                        $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                                    @endphp
                                    @if ($embedUrl)
                                        <iframe width="242" height="254" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    @endif
                                @else
                                    <video controls width="242" height="254">
                                        <source src="{{ asset('uploads/properties/videos/' . $firstVideo) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif (!empty($storedImages))
                                {{-- Display the first image --}}
                                <img src="{{ asset('uploads/properties/images/' . $storedImages[0]) }}" alt="{{ $propertyList->title }}" class="my-5 mx-4">
                            @else
                                {{-- Default Image --}}
                                <img src="{{ asset('assets/images/default-property.jpg') }}" alt="Default Property" class="my-5 mx-4">
                            @endif
        
                            <span class="nlp-tag">Featured </span>
                            @if ($propertyList->is_rera)
                                <span class="nlp-rera">
                                    <i class="fa-solid fa-medal me-2"></i> RERA
                                </span>
                            @endif
                        </div>
                        <div class="nlp-card-body">
                            {{-- Dynamic Content --}}
                            <h5 class="nlp-card-title">{{ Str::limit($propertyList->title, 25) ?? 'No Title' }}</h5>
                            <p class="nlp-card-location">{{ $propertyList->location ?? 'Unknown Location' }}</p>
                            <div class="nlp-card-price">
                                <span>
                                    <strong>
                                        @php
                                            $price = $propertyList->price;
                                            if ($price >= 10000000) {
                                                $formattedPrice = number_format($price / 10000000, 1) . ' CR';
                                            } elseif ($price >= 100000) {
                                                $formattedPrice = number_format($price / 100000, 1) . ' Lakh';
                                            } elseif ($price >= 1000) {
                                                $formattedPrice = number_format($price / 1000, 1) . ' K';
                                            } else {
                                                $formattedPrice = $price;
                                            }
                                        @endphp
                                        {{ $formattedPrice ?? 'Price on Request' }}
                                    </strong>
                                </span>
                                <span>{{ $propertyList->price_text ?? '' }}</span>
                            </div>
                            <p class="nlp-price-increase">
                              {{ Str::limit($propertyList->configuration, 25) ?? '' }}                             </p>
                            <hr>
                            <div class="nlp-card-footer">
                                <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                                    <button class="nlp-view-button">View More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
            @endif
          </div>
          <button class="nlp-scroll-btn next" onclick="scrollProjects(1)" style="display: flex;">
            ❯
          </button>
        </div>
        <button class="nlp-scroll-btn next" onclick="scrollProjects(1)">
          &#10095;
        </button>
      </div>
    </div>
  </section>

    <!-- Apartment villa and More section Start -->
    <section class="container-fluid bg-light">
      <div class="container apartment-container">
        <h2 class="home-section-title half-underline mt-4">
          Apartments, Villas & More
        </h2>
        <p class="services-section-subtitle">Explore More in Your Location</p>
        <div class="apartment-gallery-image-card-slider">
          @if (isset($properties))
          @foreach ($properties as $propertii)
          <a href="{{ route('property', ['slug' => Str::slug($propertii->name)]) }}" class="apartment-gallery-image-card" data-id="1">
            <picture>
              <img src="{{ asset($propertii->image) }}" alt="Residential Land" title="Residential Land" />
              <div class="apartment-gallery-image-card-overlay">
                <div class="apartment-gallery-image-card-title">{{ $propertii->name }}</div>
                <div class="apartment-gallery-image-card-info">{{ count($propertii->PropertiesList) }}+ Properties</div>
              </div>
            </picture>
          </a>
          @endforeach
      @endif
        </div>
      </div>
    </section>


    <section class="newly-launched-products">
      <div class="newly-launched-products-container">
        <h1 class="home-section-title half-underline">Newly Launched Properties</h1>
        <p class="services-section-subtitle slide-in-text">Brand-new properties with modern designs and high-end finishes.</p>
        <div class="swiper-container">
          <div class="swiper-wrapper">
            @if(isset($newlylanched))
              @foreach ($newlylanched as $propertyList)
                <div class="swiper-slide product">
                  @php
                    $storedImages = json_decode($propertyList->images, true);
                    $storedVideos = json_decode($propertyList->videos, true);
                  @endphp
      
                  @if (!empty($storedVideos))
                    @php
                      $firstVideo = $storedVideos[0];
                      $embedUrl = '';
                      if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/', $firstVideo, $matches)) {
                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                      }
                    @endphp
                    @if ($embedUrl)
                      <iframe class="product-media" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    @else
                      <video class="product-media" controls>
                        <source src="{{ asset('uploads/properties/videos/' . $firstVideo) }}" type="video/mp4">
                      </video>
                    @endif
                  @elseif (!empty($storedImages))
                  <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                    <img src="{{ asset('uploads/properties/images/' . $storedImages[0]) }}" alt="{{ $propertyList->title }}" class="product-media">
                  </a>
                  @else
                   <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                    <img src="{{ asset('assets/images/default-property.jpg') }}" alt="Default Property" class="product-media">
                  </a>
                  @endif
                  <span class="nlp-tag2">NEW LAUNCH</span>
                  <div class="product-content">
                    @if ($propertyList->is_rera)
                      <span class="nlp-rera">
                        <i class="fa-solid fa-medal"></i> RERA
                      </span>
                    @endif
                    <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                    <h5 class="product-title">{{ Str::limit($propertyList->title, 25) ?? 'No Title' }}</h5>
                    </a>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
          <!-- Add navigation buttons -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <!-- Add pagination -->
        </div>
      </div>
    </section>
    
    
    

      <section class="post-property-section">
      <div class="container property-register">
        <div class="post-property-section-left-content">
          <h2 class="home-section-title half-underline mb-0">{{ $register->title??'' }}</h2>
          <h4 class=" mt-4">{{ $register->subtitle??'' }}</h4>
          <div class="post-property-section-plus-content">
            <div class="post-property-section-plus">
              <h1>{{ $register->p1??'' }}</h1>
              <span>{{ $register->p1text??'' }}</span>
            </div>
            <div class="post-property-section-plus">
              <h1>{{ $register->p2??'' }}</h1>
              <span>{{ $register->p2text??'' }}</span>
            </div>
            <div class="post-property-section-plus">
              <h1>{{ $register->p3??'' }}</h1>
              <span>{{ $register->p3text??'' }}</span>
            </div>
          </div>
          <button class="post-property-button">
            <a href="{{ route('post.property') }}" class="text-white"> {{ $register->btn??'' }}</a>
          </button>
        </div>
        <div class="post-property-section-right-content">
          <img src="{{ asset('/images/'.$register->image??'') }}" alt="post Property Image" />
        </div>
      </div>
    </section>
    @if(session('alert'))
<script>
    Swal.fire({
        icon: "{{ session('alert.type') }}", // success or error
        title: "{{ session('alert.type') === 'success' ? 'Success!' : 'Error!' }}",
        text: "{{ session('alert.message') }}",
    });
</script>
@endif

<script>
   function moveCarousel(direction) {
    const carousel = document.querySelector('#carouselExample');
    const carouselInstance = new bootstrap.Carousel(carousel);
    if (direction === 1) {
      carouselInstance.next(); 
    } else {
      carouselInstance.prev();
    }
  }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.apartment-gallery-image-card-slider');
    const scrollAmount = 300; 

    function autoScroll() {
      slider.scrollLeft += scrollAmount;

      if (slider.scrollLeft >= slider.scrollWidth - slider.clientWidth) {
        slider.scrollLeft = 0;
      }
    }
    setInterval(autoScroll, 3000); 
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const products = document.querySelectorAll(".product");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      },
      { threshold: 0.2 }
    );

    products.forEach((product) => observer.observe(product));
  });




  document.addEventListener("DOMContentLoaded", () => {
  const swiper = new Swiper('.swiper-container', {
    slidesPerView: 3, // Number of slides visible
    spaceBetween: 20, // Spacing between slides
    loop: true, // Enable infinite loop
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    autoplay: {
      delay: 3000, // Auto-scroll delay in milliseconds
      disableOnInteraction: false, // Continue autoplay after interaction
    },
    breakpoints: {
      768: {
        slidesPerView: 3, // Number of slides on tablets
      },
      480: {
        slidesPerView: 1, // Number of slides on mobile
      },
    },
  });
});


</script>
<script>
  var swiper = new Swiper(".mySwiper24", {
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
      prev: {
        shadow: true,
        translate: [0, 0, -400], // 3D effect for previous slides
      },
      next: {
        translate: ["100%", 0, 0], // 3D effect for next slides
      },
    },
    loop: true, // Enable looping through the slides
    slidesPerView: 1, // Only show 1 slide at a time
    spaceBetween: 10, // Space between slides
    centeredSlides: true, // Center the active slide
    navigation: {
      nextEl: ".swiper-button-next", // Optional: add next/prev buttons
      prevEl: ".swiper-button-prev", // Optional: add next/prev buttons
    },
    autoplay: {
      delay: 2500, // Set the time interval between slides (in milliseconds)
      disableOnInteraction: false, // Keep autoplay running even if the user interacts with the Swiper
    },
  });
</script>


@endsection