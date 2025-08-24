@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.6.0/dist/nouislider.min.css">

    <style>
        /* Container */
        :root {
            --primary-color: #004aad;
            --secondary-color: #f4f5f7;
            --text-color: #333;
            --light-text-color: #666;
        }

        html {
            font-size: 16px;
        }
        #area-range {
        margin: 30px 0;
    }
#budget-range{
    width: 188px;
}
        @media (max-width: 768px) {
            html {
                font-size: 14px;
            }
        }


.ad-carousel-image {
    width: 100%;
    height: auto;
    transition: all 0.3s ease; /* Smooth transition for hover effect */
    z-index: 1; /* Make sure the image is beneath the button */
}

.view-property-btn-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none; 
    z-index: 10; /* Ensures button is on top of the image */
}

.ad-item:hover .view-property-btn-container {
    display: block; /* Show the button when the ad item is hovered */
}

/* Overlay effect for the image */
.ad-item:hover .ad-carousel-image {
    background-color: rgba(0, 0, 0, 0.5); /* Dark semi-transparent overlay */
    z-index: 2; /* Overlay stays below the button */
}

/* Button Styling */
.view-property-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.view-property-btn:hover {
    background-color: #0056b3;
}

        body {
            font-family: 'Inter', sans-serif;
            /* background-color: var(--secondary-color); */
            color: var(--text-color);
            padding-top: 180px;

        }

        .container-fluid {
            max-width: 1400px;
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-right: auto;
            margin-left: auto;
        }

        .filter-content label {
            display: block;
            margin-bottom: 5px;
            margin-left: 14px;
        }

        .property-card {
            display: flex;
            flex-direction: column;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .property-card {
                flex-direction: row;
            }
        }

        .property-image {
            position: relative;
            width: 100%;
            height: 200px;
        }

        @media (min-width: 768px) {
            .property-image {
                /* width: 50%; */
                height: auto;
            }

            body {
                padding-top: 120px;

            }
        }

        .property-image {
            flex: 0 0 40%;
            overflow: hidden;
        }

        /* .property-image img,
        .property-image iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        } */

        .property-content {
            padding: 1rem;
            flex-grow: 1;
        }

        .property-content {
            flex: 0 0 60%;
        }

        .featured-badge,
        .contacted-badge {
            position: absolute;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: bold;
            border-radius: 3px;
        }

        .featured-badge {
            top: 10px;
            left: 10px;
            background-color: #000;
            color: #fff;
        }

        .contacted-badge {
            bottom: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            z-index: 1010;
        }

        .property-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .property-des {
            font-size: 0.875rem;
            color: var(--light-text-color);
        }

        .property-price {
            font-size: 1.125rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .property-highlights {
            font-size: 0.875rem;
            margin: 0.5rem 0;
        }

        .property-description {
            font-size: 0.875rem;
            color: var(--light-text-color);
            margin-bottom: 0.5rem;
        }

        .property-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .filter-sidebar {
            background: white;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .filter-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .filter-content {
            display: none;
            margin-bottom: 1rem;
        }

        .ad-carousel {
            position: relative;
            width: 100%;
            height: 450px;
            overflow: hidden;
        }

        .ad-carousel-image {
            position: absolute;
            top: 0;
            left: 100%;
            width: 100%;
            height: 100%;
            transition: transform 0.5s ease, left 0.5s ease;
        }

        .property-buttons button {
            background-color: #004aad;
            padding: 5px;
            border-radius: 10px;
            color: white;
            border: 0px solid black;
        }

        .ad-carousel-image.active {
            left: 0;
        }

        .ad-carousel-controls {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: space-between;
    z-index: 5;
    width: 100px;
}

        .ad-control-button {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .nlp-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgb(240, 249, 255);
        }

        .nlp-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .nlp-icon {
            background-color: #e6f3ff;
            padding: 10px;
            border-radius: 8px;
            margin-right: 15px;
        }

        .nlp-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .nlp-subtitle {
            font-size: 14px;
            color: #666;
            margin: 0;
            /* animation:slide-in backwards 2s; */
        }

        .properties-container {
            position: relative;
            overflow: hidden;
        }

        .properties-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .properties-scroll::-webkit-scrollbar {
            display: none;
        }

        /* .property-card {
                flex: 0 0 auto;
                width: 300px;
                margin-right: 20px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                overflow: hidden;
                background: white;
              } */

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #007bff;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }

        .scroll-btn.prev {
            left: 10px;
        }

        .scroll-btn.next {
            right: 10px;
        }

        .nlp-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            margin-bottom: 20px;
            width: 500px;
            margin-right: 30px;
        }

        .nlp-card-img {
            width: 20%;
            position: relative;
        }

        .nlp-card-img img {
            width: 150px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            border-radius: 50%;
            border: 1px solid black;
        }

        .nlp-tag {
            position: absolute;
            top: 10px;
            left: 0;
            width: 120px;
            height: 24px;
            background-color: #fff3cd;
            color: #856404;
            text-align: center;
            font-size: 12px;
            font-weight: 800;
            line-height: 24px;
            text-transform: uppercase;
        }

        .nlp-tag:before {
            content: "";
            position: absolute;
            top: 0;
            right: -12px;
            border-left: 12px solid #fff3cd;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
        }

        .nlp-tag:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            border-top: 3px solid #856404;
            border-left: 3px solid #856404;
            border-bottom: 3px solid transparent;
            border-right: 3px solid transparent;
        }

        .nlp-rera {
            position: absolute;
            bottom: 40px;
            left: 75px;
            background-color: black;
            padding: 2px 10px;
            border-radius: 4px;
            font-size: 12px;
            display: flex;
            color: cyan;
            align-items: center;
        }

        .nlp-card-body {
            width: 80%;
            padding: 15px;
            margin-left: 15%;
            padding-top: 40px;
        }

        .nlp-card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .nlp-card-location {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .nlp-card-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .nlp-price-increase {
            color: #28a745;
            font-size: 14px;
        }

        .nlp-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .nlp-card-footer-text {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .nlp-card-footer-text i {
            margin-right: 5px;
            color: #3699db;
        }

        .nlp-btn {
            background-color: #3699db;
            color: white;
            border: none;
            padding: 6px;
            border-radius: 4px;
            font-size: 10px;
        }


        .property-image {
            position: relative;
            z-index: 1000;
            /* overflow: hidden; */
        }


        .property-image img {
            height: 320px !important;
            z-index: 9999;
            object-fit:cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background-color: rgba(211, 211, 211, 0.6);
            /* Custom background color */
            border-radius: 50%;
            border: none;
            z-index: 1020;
            /* Ensure buttons appear above image */
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.9;
            /* Slight transparency for better visibility */
            /* transition: opacity 0.3s, background-color 0.3s; */
            filter: invert(1);
        }

        .carousel-control-prev {
            left: 15px;
            /* Position to the left inside the image container */
        }

        .carousel-control-next {
            right: 15px;
            /* Position to the right inside the image container */
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            /* Darker shade on hover */
            opacity: 1;
            /* Fully visible */
        }



        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 10px;
            height: 10px;

        }

        /* .carousel-control-next-icon {
              background-color: #007bff;
              border-radius: 50%;
              width: 40px;
              height: 40px;
            } */

        .slide-in-text {
            position: relative;
            animation: slide-in 1.5s ease-out;
        }

        /* Keyframe animation for sliding in */
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Hide scrollbars for all elements */
        .scrollable-content {
            height: calc(100vh - 120px);
            /* Adjust to fit the viewport */
            overflow-y: scroll;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .scrollable-content::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, and Opera */
        }


        .fixed-ad-section {
            position: sticky;
            top: 120px;
            /* Adjust based on your header height */
            height: calc(100vh - 120px);
            /* Adjust to fit the viewport */
            overflow-y: scroll;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* Add this line to prevent horizontal scrollbar */
        }
    </style>
    
    <div class="container-fluid my-5">
        <div class="row">
            <aside class="col-lg-3 col-md-4 col-12 fixed-sidebar">
                <div class="filter-sidebar">
                    <div class="applied-filters d-flex justify-content-between">
                        <h2>Filters :</h2>
                        <span class="text-muted clear-all-filter" onclick="reloadLocation()">Clear All</span>
                    </div>

                    <div class="filter-section">
                        <div class="filter-title d-flex justify-content-between" onclick="toggleSection('property-type')">
                            Type of Property 
                            <i class="fa-solid fa-caret-down text-muted"></i>
                        </div>
                        <div class="filter-content" id="property-type" style="display: block;">
                            @if (isset($buy))
                                @foreach ($buy as $pro)
                                <label style="display: block;">
                                    <input type="checkbox" name="property_types" class="property-filter" 
                                           value="{{ $pro->name }}"> {{ $pro->name }}
                                </label>                                
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!--<div class="filter-section" bis_skin_checked="1">-->
                    <!--    <div class="filter-title d-flex justify-content-between" onclick="toggleSection('property-area')">-->
                            
                    <!--        <i class="fa-solid fa-caret-down text-muted"></i>-->
                    <!--    </div>-->
                    <!--    <div class="filter-content" id="property-area" style="display: none;">-->
                    <!--        <div id="area-range" class="form-range"></div>-->
                        
                            <!--<div class="row mt-2">-->
                                <!--<div class="col">-->
                                    <!--<input type="text" id="min-area" class="form-control text-primary" placeholder="Min Area" value="1">-->
                                <!--</div> sq.ft.-->
                                <!--<div class="col">-->
                                    <!--<input type="text" id="max-area" class="form-control" placeholder="Max Area" value="100000" >-->
                                <!--</div> sq.ft.-->
                            <!--</div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="filter-section">
                        <div class="filter-title  d-flex justify-content-between" onclick="toggleSection('budget')">Budget<i
                                class="fa-solid fa-caret-down text-muted"></i></div>
                        <div class="filter-content" id="budget" style="display: none;">
                            <input type="range" min="50000" max="1000000" step="10000" id="budget-range">
                            <span id="budget-display">₹ 50.00 k</span>
                        </div>
                    </div>
                  
                    <div class="filter-section">
                        <div class="filter-title d-flex justify-content-between" onclick="toggleSection('property-type3')">
                            Amenities<i class="fa-solid fa-caret-down text-muted"></i></div>
                        <div class="filter-content" id="property-type3">
                            @foreach ($allUniqueFeatures as $propertyyName)
                                 <label><input type="checkbox"  class="amenities-filter" value="{{ $propertyyName['name'] }}"> {{ $propertyyName['name'] }}</label>
                            @endforeach
                        </div>
                    </div>


                    <div class="filter-section">
                        <div class="filter-title d-flex justify-content-between" onclick="toggleSection('media-options')">
                            Media Options <i class="fa-solid fa-caret-down text-muted"></i>
                        </div>
                        <div class="filter-content" id="media-options">
                            <label><input type="radio" name="media" class="media-filter" value="withVideos"> Properties with Videos</label>
                            <label><input type="radio" name="media" class="media-filter" value="withPhotos"> Properties with Photos</label>
                        </div>
                    </div>
                    
                                
                                <div class="filter-section">
                        <div class="filter-title d-flex justify-content-between" onclick="toggleSection('location')">
                            Location <i class="fa-solid fa-caret-down text-muted"></i></div>
                        <div class="filter-content" id="location">
                            <select id="location-select" class="form-control">
                                <option value="">Select Location</option>
                                @foreach ($locations as $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </aside>
         <main class="col-lg-6 col-md-8 col-12 scrollable-content">
    <div class="container-fluid">
        <h3 class="fs-6 text-muted mb-4 results">
            <img src="{{ asset('/assets/images/city_insights_map.png') }}" style="width:30px;">
            {{ count($property->PropertiesList) }} Results | {{ $property->name ?? '' }}
        </h3>
        <h5 class="mb-4 text-dark">{{ $property->name ?? '' }}</h5>
        
        @if (isset($property))
            @foreach ($property->PropertiesList as $propertyy)
                <div class="property-card">
                    <div class="property-image">
                        <div id="propertyCarousel{{ $propertyy->id }}" class="carousel slide" data-bs-ride="carousel">
                            @php
                                $storedImages = json_decode($propertyy->images, true);
                                $storedVideos = json_decode($propertyy->videos, true);
                                $i = 1;
                                $hasMedia = !empty($storedVideos) || !empty($storedImages);
                                $mediaIndex = 0;
                            @endphp

                              <div class="carousel-inner">
                        {{-- Display Videos if Available --}}
                        @if (!empty($storedVideos))
                            @foreach ($storedVideos as $video)
                                @php
                                    $videoId = '';
                                    if (
                                        preg_match(
                                            '/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/',
                                            $video,
                                            $matches
                                        )
                                    ) {
                                        $videoId = $matches[1];
                                    }
                                    $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                                @endphp
                                
                                @if ($embedUrl)
                                    <div class="carousel-item {{ $mediaIndex++ === 0 ? 'active' : '' }}">
                                        <iframe width="242" height="254" src="{{ $embedUrl }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="carousel-item {{ $mediaIndex++ === 0 ? 'active' : '' }}">
                                        <video controls class="w-100">
                                            <source src="{{ asset('uploads/properties/videos/' . $video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        {{-- Display Images if Videos are Unavailable --}}
                        @if (!empty($storedImages))
                            @foreach ($storedImages as $image)
                                <div class="carousel-item {{ $mediaIndex++ === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('uploads/properties/images/' . $image) }}" class="d-block w-100" alt="{{ $property->title }}">
                                </div>
                            @endforeach
                        @endif

                        {{-- Fallback Image --}}
                        @if (!$hasMedia)
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/default-property.jpg') }}" class="d-block w-100" alt="No Media Available">
                            </div>
                        @endif
                    </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel{{ $propertyy->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel{{ $propertyy->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="property-content">
                        <div class="property-header">
                            <h3>{{ $propertyy->title }}</h3>
                            <span class="property-des">{{ $propertyy->address }}</span>
                        </div>
                        <div class="property-price">
                            <span class="price text-muted">
                                @php
                                    $price = $propertyy->price;
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
                                {{ $formattedPrice }}
                            </span>
                            <span class="price-info fw-bold mx-5 text-muted">{{ $propertyy->area }}</span>
                        </div>

                        <div class="property-highlights">
                            <span class="highlights">Highlights:</span>
                            <span>{{ $propertyy->facing }}</span>.
                            <span>{{ $propertyy->property_age }}</span>
                        </div>

                        <div class="property-description fw-bold">
                            {!! Str::limit($propertyy->about_property, 50) !!}
                        </div>

                        <div class="property-buttons">
                            <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyy->id), 'name' => Str::slug($propertyy->title)]) }}">
                                <button class="view-number">View More</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</main>

            <aside class="col-lg-3 d-none d-lg-block fixed-ad-section">
                <div class="ad-section">
                    <p class="text-center fw-bold">Advertise with us!</p>
                    <div class="ad-carousel" id="ad-carousel">
                        @if (isset($advertisements))
                            @foreach ($advertisements as $advertisement)
                                <div class="ad-item">
                                    <!-- Advertisement Image -->
                                    <div class="ad-image-container">
                                        <img src="{{ asset($advertisement->ad_image) }}" alt="Advertisement Image" class="ad-carousel-image image-1" />
                                        
                                        <!-- View Property Button -->
                                        <div class="view-property-btn-container">
                                            <a href="{{ route('property-view', ['slug' => \Hashids::encode($advertisement->property_id), 'name' => Str::slug($advertisement->property->title)]) }}" 
                                               class="btn btn-primary view-property-btn" 
                                               target="_blank" 
                                               rel="noopener noreferrer">
                                               View Property
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="ad-carousel-controls">
                            <button class="ad-control-button" id="adPrevBtn">&#9664;</button>
                            <button class="ad-control-button" id="adNextBtn">&#9654;</button>
                        </div>
                    </div>
                </div>
            </aside>
            
            
        </div>
    </div>
    <div class=" container nlp-container">
        <div class="nlp-header">
            <div class="nlp-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 21H21" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M5 21V7L13 3V21" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M19 21V11L13 7" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M9 9V9.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M9 13V13.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M9 17V17.01" stroke="#007BFF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div>
                <h1 class="nlp-title">Featured Properties</h1>
                <p class="nlp-subtitle slide-in-text">Less upfront payment</p>
            </div>
        </div>

        <div class="properties-container">
            <button class="scroll-btn prev" onclick="scrollProperties(-1)">
                &#10094;
            </button>
            <div class="properties-scroll" id="propertiesScroll">
                 @if (isset($futuredProperties))
            @foreach ($futuredProperties as $propertyList)
            @php
                $storedImages = json_decode($propertyList->images, true);
                $storedVideos = json_decode($propertyList->videos, true);
            @endphp
            <div class="property-card1">
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
        
                            <span class="nlp-tag">NEW LAUNCH</span>
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
            <button class="scroll-btn next" onclick="scrollProperties(1)">
                &#10095;
            </button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.0/dist/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>


document.addEventListener('DOMContentLoaded', function () {
        let currentIndex = 0; // Track the current image index
        const images = document.querySelectorAll(".ad-carousel-image");
        const totalImages = images.length;

        // Auto-scroll functionality
        function autoScroll() {
            showNextImage();
            setTimeout(autoScroll, 3000); // Change image every 3 seconds
        }

        // Show the next image
        function showNextImage() {
            const previousIndex = currentIndex;
            currentIndex = (currentIndex + 1) % totalImages; // Move to the next image
            updateCarousel(previousIndex, currentIndex);
        }

        // Show the previous image
        function showPrevImage() {
            const previousIndex = currentIndex;
            currentIndex = (currentIndex - 1 + totalImages) % totalImages; // Move to the previous image
            updateCarousel(previousIndex, currentIndex);
        }

        // Update the carousel to display the correct images
        function updateCarousel(previousIndex, currentIndex) {
            images.forEach((img, index) => {
                img.classList.remove("active", "previous", "next");
                if (index === currentIndex) {
                    img.classList.add("active");
                } else if (index === previousIndex) {
                    img.classList.add("previous");
                }
            });
        }

        // Event listeners for navigation controls
        document.getElementById("adPrevBtn").addEventListener("click", showPrevImage);
        document.getElementById("adNextBtn").addEventListener("click", showNextImage);

        // Initialize the carousel
        updateCarousel(currentIndex, currentIndex);
        autoScroll(); // Start auto-scrolling
        });
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.style.display = section.style.display === "block" ? "none" : "block";
        }

        // function applyAreaFilter() {
        //     const minArea = document.getElementById("min-area").value;
        //     const maxArea = document.getElementById("max-area").value;
        //     if (minArea && maxArea) {
        //         addAppliedFilter(`Area: ${minArea} - ${maxArea} sq.ft.`);
        //     }
        // }

        // function addAppliedFilter(filterText) {
        //     const list = document.getElementById("applied-filters-list");
        //     const li = document.createElement("li");
        //     li.textContent = filterText;
        //     list.appendChild(li);
        // }

        document.getElementById("budget-range").addEventListener("input", function () {
    var value = this.value;
    value = formatPrice(value); 
    document.getElementById("budget-display").textContent = `₹ ${value}`; 
        });

        function formatPrice(price) {
            price = parseInt(price, 10); 
            if (price >= 10000000) {
                return `${(price / 10000000).toFixed(2)}cr`; 
            } else if (price >= 100000) {
                return `${(price / 100000).toFixed(2)}lkh`;
            } else if (price >= 1000) {
                return `${(price / 1000).toFixed(2)}k`; 
            } else {
                return price.toLocaleString(); 
            }
        }

        // document.querySelectorAll(".filter-content input, .filter-content select").forEach((field) => {
        //     field.addEventListener("change", function() {
        //         const filterText = this.value ? this.value : this.placeholder;
        //         addAppliedFilter(filterText);
        //     });
        // });

        function scrollProperties(direction) {
            const container = document.getElementById("propertiesScroll");
            const scrollAmount = container.clientWidth / 3; // Adjust based on visible properties
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: "smooth",
            });
        }
        const container = document.getElementById("propertiesScroll");
        // const totalProperties =
        //   document.querySelectorAll(".property-card1").length;
        // const visibleProperties = 3; 

        function updateScrollButtons() {
            const scrollLeft = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;

            document.querySelector(".scroll-btn.prev").style.display =
                scrollLeft > 0 ? "flex" : "none";
            document.querySelector(".scroll-btn.next").style.display =
                scrollLeft < maxScroll ? "flex" : "none";
        }

        document
            .querySelector(".scroll-btn.next")
            .addEventListener("click", () => scrollProperties(1));
        document
            .querySelector(".scroll-btn.prev")
            .addEventListener("click", () => scrollProperties(-1));

        container.addEventListener("scroll", updateScrollButtons);

        updateScrollButtons();

        function reloadLocation() {
            window.location.reload();
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.property-filter');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    
                    applyFilters();
                });
            });
    
            function applyFilters() {
                let selectedTypes = [];
                document.querySelectorAll('.property-filter:checked').forEach(checkbox => {
                    selectedTypes.push(checkbox.value);
                });
    
                fetch("{{ route('filter-properties') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ property_types: selectedTypes })
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.scrollable-content .container-fluid').innerHTML = data.html;
                })
                .catch(error => console.error('Error:', error));
            }
        });
        document.addEventListener("DOMContentLoaded", () => {
    const filters = document.querySelectorAll(".property-filter, #budget-range, #location-select, .amenities-filter, .media-filter");
    const resultsContainer = document.querySelector(".scrollable-content .container-fluid");
    
    var areaRange = document.getElementById('area-range');
    var minAreaInput = document.getElementById('min-area');
    var maxAreaInput = document.getElementById('max-area');

    // noUiSlider.create(areaRange, {
    //     start: [0, 10000],   
    //     connect: true,        
    //     range: {
    //         'min': 0,
    //         'max': 10000
    //     },
    //     step: 10,            
    //     tooltips: [true, true], 
    //     format: {
    //         to: function (value) {
    //             return Math.round(value);  
    //         },
    //         from: function (value) {
    //             return value;  
    //         }
    //     }
    // });
    let isManualChange = false; 

// areaRange.noUiSlider.on('start', function () {
//     isManualChange = true; 
// });

// areaRange.noUiSlider.on('set', function (values) {
//     console.log(values); 

//     minAreaInput.value = values[0] === 0 ? 1 : values[0];
//     maxAreaInput.value = values[1];

//     if (isManualChange) {
//         applyFilters();
//         isManualChange = false; 
//     }
// });


    filters.forEach(filter => {
        filter.addEventListener("change", applyFilters);
    });

    // minAreaInput.addEventListener("input", function () {
    //     areaRange.noUiSlider.set([minAreaInput.value, areaRange.noUiSlider.get()[1]]);
    //     applyFilters();
    // });

    // maxAreaInput.addEventListener("input", function () {
    //     areaRange.noUiSlider.set([areaRange.noUiSlider.get()[0], maxAreaInput.value]);
    //     applyFilters();
    // });

    function applyFilters() {
        console.log("filter call");
        
        const selectedFilters = {
            property_types: Array.from(document.querySelectorAll('input[name="property_types"]:checked')).map(input => input.value),
            amenities: Array.from(document.querySelectorAll('#property-type3 input:checked')).map(input => input.value),
            budget: document.querySelector("#budget-range").value == 530000 ? '' : document.querySelector("#budget-range").value,
            media: Array.from(document.querySelectorAll('#media-options input:checked')).map(input => input.value),
            location: document.querySelector("#location-select").value,
        };
        
        fetchFilteredResults(selectedFilters);
    }

    function fetchFilteredResults(filters) {
        console.log("calling ajax");
        console.log(filters);
        
        fetch("{{ route('filter-properties') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify(filters),
        })
        .then(response => response.json())
        .then(data => {
            resultsContainer.innerHTML = data.html; // Update the results container with the new HTML
        })
        .catch(error => console.error("Error fetching filtered results:", error));
    }

    document.querySelector(".clear-all-filter").addEventListener("click", () => {
        filters.forEach(filter => {
            if (filter.type === "checkbox") filter.checked = false;
            if (filter.type === "range") filter.value = filter.min;
            if (filter.tagName === "SELECT") filter.selectedIndex = 0;
        });

        areaRange.noUiSlider.set([0, 10000]);

        applyFilters();
    });
});

    </script>
    
@endsection
