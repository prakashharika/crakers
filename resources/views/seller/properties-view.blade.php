<x-app-seller-layout>
    <style>
        .main-app {
            padding: 40px 20px;
        }

        .main-title {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }
        .card {
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 40px;
        }

        .card p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .card h5 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-top: 25px;
            text-transform: uppercase;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .row {
            margin-top: 20px;
        }

        .col-md-4, .col-md-6 {
            margin-bottom: 15px;
        }

        .image-preview {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }

        iframe, video {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
            width: 100%;
            height: 315px;
        }

        .video-container iframe,
        .video-container video {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .main-app {
                padding: 20px;
            }

            .btn-secondary {
                font-size: 14px;
                padding: 10px 20px;
            }

            .image-preview {
                height: auto;
            }

            iframe, video {
                height: 200px;
            }
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="main-title">{{ $property->title }}</h4>
                </div>
                <div>
                    <a href="{{ route('property-seller-list',['id' => $property->property_id]) }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div> 
            <div class="card">
                <p><strong>Area:</strong> {{ $property->area }}</p>
                <p><strong>Configuration:</strong> {{ $property->configuration }}</p>
                <p><strong>Price:</strong> {{ $property->price }}</p>
                <p><strong>Address:</strong> {{ $property->address }}</p>
                <p><strong>Total Floors:</strong> {{ $property->total_floors }}</p>
                <p><strong>Facing:</strong> {{ $property->facing }}</p>
                <p><strong>Property Age:</strong> {{ $property->property_age }}</p>
                @php
                $nearPaces = json_decode($property->near_by_places, true); 
                $features = json_decode($property->features, true); 
                 @endphp
                <p><strong>Near By Places:</strong> 
                    @if ($nearPaces)
                    @foreach($nearPaces as $paces) 
                       <i class="{{ $paces['icon'] }}"></i> {{ $paces['name'] }}  
                    @endforeach
                 @endif 
                </p>
                <p><strong>About Property:</strong> {{ $property->about_property }}</p>
                <p><strong>Futures:</strong>
                     @if ($features)
                        @foreach($features as $feature) 
                           <i class="{{ $feature['icon'] }}"></i> {{ $feature['name'] }}  
                        @endforeach
                     @endif 
                    </p>

                <h5>Images:</h5>
                <div class="row">
                    @php
                    $storedImages = json_decode($property->images, true); 
                    $storedVideos = json_decode($property->videos, true); 
                @endphp
                
                @if ($storedImages)
                    @foreach($storedImages as $image) 
                        <div class="col-md-4">
                            <img src="{{ asset('uploads/properties/images/' . $image) }}" class="image-preview" alt="Property Image" />
                        </div>
                    @endforeach
                @endif                
                </div>

                @if ($storedVideos)
                <h5>Videos:</h5>
                <div class="video-container row">
                    @foreach($storedVideos as $video) 
                        <div class="col-md-6">
                            @if (filter_var($video, FILTER_VALIDATE_URL)) 
                                {{-- If video is a URL, display it in an iframe --}}

                                @php
                                $videoId = '';
                                if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/', $video, $matches)) {
                                    $videoId = $matches[1];
                                }
                                $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                                @endphp
                            
                                @if ($embedUrl)
                                    {{-- Embed the video in an iframe --}}
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <p>Invalid YouTube URL</p>
                                @endif
                            @else
                                {{-- If video is a local file, display it in a video player --}}
                                <video controls>
                                    <source src="{{ asset('uploads/properties/videos/' . $video) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endif  
            </div>
        </div>
    </div>
</x-app-seller-layout>
