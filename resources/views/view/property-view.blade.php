@extends('layouts.main')

@section('content')
    <style>
        :root {
            --primary-color: #004aad;
            --secondary-color: #f4f5f7;
            --text-color: #333;
            --light-text-color: #666;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);

        }
        .text-primary{
           color: #0B62E0 !important;
         }
        .btn-primary {
            color: #fff;
            background-color: #0B62E0;
            border-color: #0B62E0;
            border-radius: 4px;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #003b8f;
            border-color: #023781;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px 15px;
        }

        /* Responsive typography */
        html {
            font-size: 16px;
        }

        @media (max-width:576px) {
            body {
                padding-top: 250px;
            }
        }

        @media (min-width:577px) {
            body {
                padding-top: 150px;
            }
        }

        @media screen and (min-width: 320px) {
            html {
                font-size: calc(16px + 2 * ((100vw - 320px) / 680));
            }


        }

        @media screen and (min-width: 1000px) {
            html {
                font-size: 18px;
            }


        }

        /* Property container styles */
        .property-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .property-container {
                flex-direction: row;
            }
        }

        .carousel-container {
            position: relative;
            width: 100%;
            height: 300px;
        }

        @media (min-width: 768px) {
            .carousel-container {
                width: 50%;
                height: 400px;
            }
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            font-size: 1.5rem;
            padding: 0.5rem;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
        }

        .carousel-button:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        .property-details {
            width: 100%;
            background-color: #fff;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .property-details {
                width: 50%;
            }
        }

        .property-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .specs-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .spec-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .icon-container {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .spec-content {
            flex-grow: 1;
        }

        .spec-label {
            font-size: 0.875rem;
            color: var(--light-text-color);
            margin-bottom: 0.25rem;
        }

        .spec-value {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .spec-subtext {
            font-size: 0.75rem;
            color: var(--light-text-color);
        }

        /* Places nearby styles */
        .places-container {
            margin: 2rem 0;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #3699db;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .places-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .places-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.125rem;
            font-weight: bold;
        }

        .view-all {
            color: #3699db;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .places-scroll {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding: 0.5rem 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .places-scroll::-webkit-scrollbar {
            display: none;
        }

        .place-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            white-space: nowrap;
            color: #3699db;
            background-color: #f0f7ff;
            border-radius: 20px;
        }

        .properties-container {
            position: relative;
            overflow: hidden;
        }

        .properties-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 1rem;
            padding: 1rem 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .properties-scroll::-webkit-scrollbar {
            display: none;
        }

        .property-card {
            flex: 0 0 auto;
            width: 280px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            background: white;
        }

        .property-image {
            position: relative;
            height: 180px;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .property-details1 {
            padding: 1rem;
        }

        .owner-info {
            font-size: 0.75rem;
            color: var(--light-text-color);
            margin-bottom: 0.5rem;
        }

        .price {
            font-size: 1rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .location {
            font-size: 0.875rem;
            color: var(--light-text-color);
            margin-bottom: 0.75rem;
        }

        .enquire-btn {
            background-color: #00a69c;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            width: 100%;
            font-size: 0.875rem;
            transition: background-color 0.3s;
        }

        .enquire-btn:hover {
            background-color: #008c84;
        }

        .verified-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #28a745;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            color: white;
            border: none;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }

        .scroll-btn.prev {
            left: 0.5rem;
        }

        .scroll-btn.next {
            right: 0.5rem;
        }

        /* Featured properties styles */
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

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-next-icon {
            background-color: #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

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

        /* Responsive adjustments */
        @media (max-width: 767px) {

            .property-container,
            .specs-container {
                flex-direction: column;
            }

            .carousel-container,
            .property-details {
                width: 100%;
            }

            .places-scroll,
            .properties-scroll {
                overflow-x: auto;
            }

            .scroll-btn {
                display: none;
            }
        }

        /* High DPI screens */
        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {

            .carousel-image,
            .property-image img,
            .nlp-card-img img {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }
    </style>

    <div class="container mt-3">
        <div class="view-property-header">
            <img src="{{asset('/assets/images/city_insights_map.png')}}" alt="insight image" class="mx-2" style="width:24px; height:27px;">
            <div class="header-1">
                <h2 class="text-dark fw-bold">@php
                    $price = $property->price;
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
                {{ $formattedPrice }}, 
            {{ $property->price_text ?? '' }}
                </h2>
            </div>
            <div class="header-2">
                <h4 class="text-muted">{{ $property->configuration ?? '' }}</h4>
            </div>
        </div>
        <div class="property-container">
            <div class="carousel-container">
                @php
                // Decode the videos and images only once for performance
                $videos = json_decode($property->videos, true);
                $images = json_decode($property->images, true);
                $videoId = '';
                $embedUrl = '';
            @endphp
            @if (!empty($videos[0]))
                @php
                    if (preg_match(
                        '/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/',
                        $videos[0],
                        $matches
                    )) {
                        $videoId = $matches[1];
                    }
                    $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                @endphp
            
                @if ($embedUrl)
                    <iframe class="iframe" width="600" height="400" src="{{ $embedUrl }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @endif
            @elseif (!empty($images[0]))
                <img id="carouselImage" class="carousel-image"
                    src="{{ asset('uploads/properties/images/' . $images[0]) }}"
                    alt="Property image" />
            @else
                <img id="carouselImage" class="carousel-image"
                    src="{{ asset('/assets/images/placeholder-image.png') }}"
                    alt="Property image" />
            @endif
            
                <button class="carousel-button carousel-prev" onclick="changeImage(-1)">&#10094;</button>
                <button class="carousel-button carousel-next" onclick="changeImage(1)">&#10095;</button>
            </div>
            <div class="property-details">
                <h2 class="property-title">{{ $property->title ?? '' }}</h2>
                <div class="specs-container">
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #e6fffa">
                            <i class="fas fa-building" style="color: #0d9488"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Area</div>
                            <div class="spec-value">{{ $property->area ?? '' }} </div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #e6fffa">
                            <i class="fas fa-th-large" style="color: #0d9488"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Configuration</div>
                            <div class="spec-value">{{ $property->configuration ?? '' }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #fff7ed">
                            <i class="fas fa-rupee-sign" style="color: #d97706"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Price</div>
                            <div class="spec-value">@php
                                $price = $property->price;
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
                        </div> 
                        {{ $property->price_text ?? '' }}
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #eff6ff">
                            <i class="fas fa-map-marker-alt" style="color: #2563eb"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Address</div>
                            <div class="spec-value">{{ $property->address ?? '' }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #f3e8ff">
                            <i class="fas fa-layer-group" style="color: #7c3aed"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Total Floors</div>
                            <div class="spec-value">{{ $property->total_floors ?? '' }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #f1f5f9">
                            <i class="fas fa-compass" style="color: #475569"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Facing</div>
                            <div class="spec-value">{{ $property->facing ?? '' }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="icon-container" style="background-color: #ecfdf5">
                            <i class="fas fa-clock" style="color: #059669"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Property Age</div>
                            <div class="spec-value">{{ $property->property_age ?? '' }}</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <a href="{{ route('sales.interest', ['slug' => \Hashids::encode($property->id)]) }}" class="btn btn-primary"> I'm interested</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="places-container">
        <div class="places-header">
            <div class="places-title">
                <img src="{{ asset('/assets/images/landmarkGroup.png') }}" alt="landmark icon" style="width:40px; height:40px;">
                <div>
                    <h2 class="text-muted fw-bold fs-4">Places nearby</h2>
                    <span class="fs-6 text-dark">{{ $property->address ?? '' }}</span>
                </div>
            </div>
            {{-- <a href="#" class="view-all">View All (50)</a> --}}
        </div>
        <div class="places-scroll">
            <div class="places-scroll">
                @if (isset($property->near_by_places) && !empty($property->near_by_places))
                    @php
                        $places = json_decode($property->near_by_places, true); // Decode JSON to an array
                    @endphp
                    @if (is_array($places) && !empty($places))
                        @foreach ($places as $place)
                            <div class="place-item">
                                <i class="{{ $place['icon'] }}"></i>
                                {{ $place['name'] }}
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="container about-property-section">
        <div class="about-title">
            <h4 class="text-muted fs-4 fw-bold">About Property</h4>
            <hr>
            <p class="text-dark">{{ $property->address ?? '' }}</p>
            <p class="text-muted fs-6">{{ $property->about_property ?? '' }}</p>
        </div>
        <div class="about-title">
            <h4 class="text-muted fw-bold fs-4">Features</h4>
            <hr>
            <div class="row">
                @if (isset($property->features) && !empty($property->features))
                    @php
                        $places = json_decode($property->features, true); // Decode JSON to an array
                    @endphp
                    @if (is_array($places) && !empty($places))
                        @foreach ($places as $place)
                            <p class="col-lg-3 text-dark "><i class="{{ $place['icon'] }} fs-4 text-warning me-2"></i>
                                {{ $place['name'] }}</p>
                        @endforeach
                    @endif
                @endif

            </div>
        </div>
    </div>

    <div class="container similar-properties">
        <h2 class="mb-4 fs-4 fw-bold">Similar Properties</h2>
        <div class="properties-container">
            <button class="scroll-btn prev" onclick="scrollProperties('propertiesScroll', -1)">&#10094;</button>
            <div class="properties-scroll" id="propertiesScroll">
                @if (isset($similarProperties) && $similarProperties->count() > 0) 
                @foreach ($similarProperties as $similarProperty)
                    @foreach ($similarProperty->PropertiesList as $propertyList)
                        @php
                            $storedImages = json_decode($propertyList->images, true);
                            $storedVideos = json_decode($propertyList->videos, true);
                            $mediaIndex = 0;  // To track the first item for images or videos
                        @endphp
                        <div class="property-card">
                            <div class="property-image">
                                @if (!empty($storedVideos)) 
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
                                    <img src="{{ asset('uploads/properties/images/' . $storedImages[0]) }}" alt="Property" class="d-block w-100">
                                @else
                                    <img src="{{ asset('assets/images/default-property.jpg') }}" alt="No Media" class="d-block w-100">
                                @endif
                            </div>
                            <div class="property-details1">
                                <div class="owner-info">
                                    {{ Str::limit($propertyList->title, 25) ?? '' }} 
                                    {{ \Carbon\Carbon::parse($propertyList->created_at)->format('d M, Y') }}
                                </div>
                                <div class="price">
                                    ₹ @php
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
                                    {{ $formattedPrice }}{{ $propertyList->price_text ? ', ' . Str::limit($propertyList->price_text, 12) : '' }}
                                </div>
                                <div class="location">{{ $propertyList->location }}</div>
                                <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                                    <button class="enquire-btn">Enquire Now</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endif
            
            
            </div>
            <button class="scroll-btn next" onclick="scrollProperties('propertiesScroll', 1)">&#10095;</button>
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
            <button class="scroll-btn prev" onclick="scrollProperties('projectScroll', -1)">
                &#10094;
            </button>
            <div class="properties-scroll" id="projectScroll">
                @if (isset($futuredProperties))
                @foreach ($futuredProperties as $propertyList)
                @php
                    $storedImages = json_decode($propertyList->images, true);
                    $storedVideos = json_decode($propertyList->videos, true);
                    $mediaIndex = 0;
                @endphp
                <div class="property-card1">
                    <div class="col-lg-4">
                        <div class="nlp-card d-flex">
                            <div class="nlp-card-img">
                                {{-- Dynamic Media Display --}}
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
                                    <img src="{{ asset('uploads/properties/images/' . $storedImages[0]) }}" alt="Property" class="my-5 mx-4">
                                @else
                                    {{-- Default Image if no media is found --}}
                                    <img src="{{ asset('assets/images/default-property.jpg') }}" alt="No Media" class="my-5 mx-4">
                                @endif
            
                                <span class="nlp-tag">NEW LAUNCH</span>
                                <span class="nlp-rera">
                                    <i class="fa-solid fa-medal"></i> RERA
                                </span>
                            </div>
                            <div class="nlp-card-body">
                                <h5 class="nlp-card-title">{{ Str::limit($propertyList->title, 25) ?? ' ' }}</h5>
                                <p class="nlp-card-location">{{ $propertyList->location ?? ' ' }}</p>
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
                                    {{ Str::limit($propertyList->configuration, 25) ?? ' ' }} 
                                </p>
                                <hr />
                                <div class="nlp-card-footer">
                                    <a href="{{ route('property-view', ['slug' => \Hashids::encode($propertyList->id), 'name' => Str::slug($propertyList->title)]) }}">
                                        <button class="nlp-btn">View More</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
                
            </div>
            <button class="scroll-btn next" onclick="scrollProperties('projectScroll', 1)">
                &#10095;
            </button>
        </div>
    </div>
    <script>
        var images = [
            @foreach (json_decode($property->images) as $image)
                "{{ asset('uploads/properties/images/' . $image) }}",
            @endforeach
        ];
        let currentImageIndex = 0;

        function changeImage(direction) {
            currentImageIndex += direction;
            if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            } else if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            }
            console.log(images);
            let carouselImage = document.getElementById("carouselImage");
            const iframe = document.querySelector('.iframe');
            if (!carouselImage || carouselImage.src === "" || carouselImage.src === "data:,") {
                carouselImage = document.createElement("img");
                carouselImage.classList.add("carousel-image");
                carouselImage.id = "carouselImage";
                carouselImage.src = images[currentImageIndex];
                const carouselContainer = document.querySelector(".carousel-container");
                carouselContainer.appendChild(carouselImage);
                iframe.style.display = 'none';
            } else {
                carouselImage.src = images[currentImageIndex];
            }
        }

        function scrollProperties(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = container.clientWidth / 2;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
            updateScrollButtons(containerId);
        }

        // Update scroll buttons visibility
        function updateScrollButtons(containerId) {
            const container = document.getElementById(containerId);
            const prevBtn = container.parentElement.querySelector('.scroll-btn.prev');
            const nextBtn = container.parentElement.querySelector('.scroll-btn.next');

            if (container.scrollLeft > 0) {
                prevBtn.style.display = 'flex';
            } else {
                prevBtn.style.display = 'none';
            }

            if (container.scrollLeft < (container.scrollWidth - container.clientWidth)) {
                nextBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'none';
            }
        }

        // Initialize scroll button visibility
        document.addEventListener('DOMContentLoaded', function() {
            updateScrollButtons('propertiesScroll');
            updateScrollButtons('projectScroll');
        });

        // Update scroll buttons on scroll
        document.getElementById('propertiesScroll').addEventListener('scroll', function() {
            updateScrollButtons('propertiesScroll');
        });

        document.getElementById('projectScroll').addEventListener('scroll', function() {
            updateScrollButtons('projectScroll');
        });
        // Responsive font size adjustment
        function adjustFontSize() {
            const width = window.innerWidth;
            const baseFontSize = 16;
            const minFontSize = 14;
            const maxFontSize = 18;

            if (width < 768) {
                document.documentElement.style.fontSize = `${minFontSize}px`;
            } else if (width > 1200) {
                document.documentElement.style.fontSize = `${maxFontSize}px`;
            } else {
                const scaleFactor = (width - 768) / (1200 - 768);
                const fontSize = baseFontSize + scaleFactor * (maxFontSize - baseFontSize);
                document.documentElement.style.fontSize = `${fontSize}px`;
            }
        }

        // Call adjustFontSize on load and resize
        window.addEventListener('load', adjustFontSize);
        window.addEventListener('resize', adjustFontSize);

        // Lazy loading images
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Fallback for browsers that don't support IntersectionObserver
                let active = false;

                const lazyLoad = function() {
                    if (active === false) {
                        active = true;

                        setTimeout(function() {
                            lazyImages.forEach(function(lazyImage) {
                                if ((lazyImage.getBoundingClientRect().top <= window
                                        .innerHeight && lazyImage.getBoundingClientRect()
                                        .bottom >= 0) && getComputedStyle(lazyImage).display !==
                                    "none") {
                                    lazyImage.src = lazyImage.dataset.src;
                                    lazyImage.classList.remove("lazy");

                                    lazyImages = lazyImages.filter(function(image) {
                                        return image !== lazyImage;
                                    });

                                    if (lazyImages.length === 0) {
                                        document.removeEventListener("scroll", lazyLoad);
                                        window.removeEventListener("resize", lazyLoad);
                                        window.removeEventListener("orientationchange",
                                            lazyLoad);
                                    }
                                }
                            });

                            active = false;
                        }, 200);
                    }
                };

                document.addEventListener("scroll", lazyLoad);
                window.addEventListener("resize", lazyLoad);
                window.addEventListener("orientationchange", lazyLoad);
            }
        });
    </script>
@endsection
