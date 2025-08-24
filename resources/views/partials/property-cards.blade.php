@if ($properties->isNotEmpty())
    @foreach ($properties as $property)
            @php
                $storedImages = json_decode($property->images, true);
                $storedVideos = json_decode($property->videos, true);
                $hasMedia = !empty($storedVideos) || !empty($storedImages);
                $mediaIndex = 0;
            @endphp
        <div class="property-card" bis_skin_checked="1">
            <div class="property-image" bis_skin_checked="1">
                <div id="propertyCarousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel" bis_skin_checked="1">
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

                    {{-- Carousel Controls --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="property-content">
                <div class="property-header">
                    <h3>{{ $property->title }}</h3>
                    <span class="property-des">{{ $property->address }}</span>
                </div>
                <div class="property-price">
                    <span class="price text-muted">
                        @php
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
            </span>
                    <span class="price-info fw-bold mx-5 text-muted">{{ $property->area }} sq.ft.</span>
                </div>
                <div class="property-highlights">
                    <span class="highlights">Highlights : </span>
                    <span>{{ $property->facing }}</span>.
                    <span>{{ $property->property_age }}</span>
                </div>
                <div class="property-description fw-bold">
                    {!! Str::limit($property->about_property, 50) !!}
                </div>
                <div class="property-buttons">
                    <a href="{{ route('property-view', ['slug' => \Hashids::encode($property->id), 'name' => Str::slug($property->title)]) }}">
                        <button class="view-number">View More</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No properties found.</p>
@endif
