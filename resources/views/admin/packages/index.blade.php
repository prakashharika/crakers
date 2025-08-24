<x-app-layout>
    <style>
        .row {
            background: #fff;
        }
        .container {
        max-width: 1200px;
        margin: 0 auto;

    }

    .package-title {
        font-size: 2rem !important;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1rem;
        color: #004aad;
    }

    .package__title {
        font-size: 1.5rem !important;
        font-weight: 700;
        text-align: center;
        margin-bottom: 0.5rem;

    }

    .packages {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .package {
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .package--highlighted {
        border: 2px solid #3699db;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .package__header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }


    .package__description {
        color: var(--muted);
        font-size: 1rem !important;
    }

    .package__content {
        padding: 1.5rem;
        flex-grow: 1;
    }

    .package__price {
        font-size: 2.25rem !important;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #3699db;
    }

    .package__price-suffix {
        font-size: 0.875rem;
        font-weight: 400;
    }

    .package__features {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .package__feature {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .package__feature::before {
        content: '✓';
        color: #10b981;
        margin-right: 0.5rem;
    }

    .package__feature--not-included {
        color: var(--muted-foreground);
    }

    .package__feature--not-included::before {
        content: '✕';
        color: #ef4444;
    }

    .package__footer {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .button {
        display: block;
        /* width: 100%; */
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        background-color: #3699db;
        color: var(--primary-foreground);
        border: 1px solid #3699db;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s, border-color 0.2s;
    }

    .professional-button {
        color: whitesmoke !important;
    }
    </style>
    
    <div class="main main-app p-3 p-lg-4">
        <div class="container">
           
            <h2 class="package-title">Choose a package to edit</h2>
            @if (session('success'))
            <script>
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28a745",  // Green for success
                    stopOnFocus: true,
                }).showToast();
            </script>
        @endif
       

            <div class="packages">
                <div class="package">
                    <div class="package__header">
                        <a href="{{ route('packages.edit', ['id' => 1]) }}" class="btn btn-primary mb-2">Edit</a>
                        <h2 class="package__title">{{$package1->title ?? 'Basic'}}</h2>
                        <p class="package__description text-center">{{ $package1->content ?? 'Perfect for individual property owners'}}</p>
                    </div>
                    <div class="package__content">
                        <p class="package__price">&#8377; {{$package1->price ?? '1500'}}<span
                                class="package__price-suffix text-dark fw-bold"></span></p>
                        <ul class="package__features">
                            <!-- Display Price Type dynamically -->
                            <ul class="package__features">
                                <!-- Display no_property_listing if not null -->
                                @if(isset($package1->no_property_listing))
                                <li class="package__feature">{{ $package1->no_property_listing ?? ''  }} property listing</li>

                                @endif

                                <!-- Display property_visibility_days if not null -->
                                @if(isset($package1->property_visibility_days))
                                <li class="package__feature">{{ $package1->property_visibility_days ?? ''  }} days visibility</li>

                                @endif

                                <!-- Display upto_images if not null -->
                                @if(isset($package1->upto_images))
                                <li class="package__feature">  Upto {{ $package1->upto_images ?? ''  }} photos</li>


                                @endif

                                <!-- Display upto_video if not null -->
                                @if(isset($package1->upto_video))
                                    <li class="package__feature"> Upto {{ $package1->upto_video ?? '' }} Videos</li>
                                @endif

                                <!-- Display future_listing_days if not null -->
                                @if(isset($package1->future_listing_days))
                                <li class="package__feature">{{ $package1->future_listing_days ?? '' }} Featured listing days</li>

                                @endif



                                <!-- Display 'extra features' dynamically from package -->
                                @foreach($package1->extra_features as $feature)
                                <li class="package__feature">{{ $feature }}</li>
                                @endforeach
                                <!-- Display 'not included' features dynamically from package -->
                                @foreach($package1->not_included as $feature)
                                <li class="package__feature package__feature--not-included">{{ $feature }}</li>
                                @endforeach


                            </ul>

                    </div>
                    <div class="package__footer">
                        <a href="javascript:void(0)" class="button button--outline choose-package-btn" style="background-color: #fff;" disabled>{{$package1->button_title ?? 'Choose Basic'}}</a>
                    </div>
                </div>
                <div class="package package--highlighted">
                    <div class="package__header">
                    <a href="{{ route('packages.edit', ['id' => 2]) }}" class="btn btn-secondary mb-2">Edit</a>
                        <h2 class="package__title">{{$package2->title ?? 'Basic'}}</h2>
                        <p class="package__description text-center">{{$package2->content ?? 'Perfect for individual property owners'}}</p>
                    </div>
                    <div class="package__content">
                        <p class="package__price">&#8377; {{$package2->price ?? '1500'}}<span
                                class="package__price-suffix text-dark fw-bold"></span></p>
                        <ul class="package__features">
                            <!-- Display Price Type dynamically -->
                            @if(isset($package2->no_property_listing))
                            <li class="package__feature">{{ $package2->no_property_listing ?? ''  }} property listing </li>

                            @endif

                            <!-- Display property_visibility_days if not null -->
                            @if(isset($package2->property_visibility_days))
                            <li class="package__feature">{{ $package2->property_visibility_days ?? ''  }} days visibility</li>

                            @endif

                            <!-- Display upto_images if not null -->
                            @if(isset($package2->upto_images))
                            <li class="package__feature">  Upto {{ $package2->upto_images ?? ''  }} photos</li>


                            @endif

                            <!-- Display upto_video if not null -->
                            @if(isset($package2->upto_video))
                            <li class="package__feature"> Upto {{ $package2->upto_video ?? '' }} Videos</li>
                            @endif

                            <!-- Display future_listing_days if not null -->
                            @if(isset($package2->future_listing_days))
                            <li class="package__feature">{{ $package2->future_listing_days ?? '' }} Featured listing days</li>

                            @endif


                            <!-- Display 'extra features' dynamically from package -->
                            @foreach($package2->extra_features as $feature)
                            <li class="package__feature">{{ $feature }}</li>
                            @endforeach
                            <!-- Display 'not included' features dynamically from package -->
                            @foreach($package2->not_included as $feature)
                            <li class="package__feature package__feature--not-included">{{ $feature }}</li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="package__footer">
                        <a href="javascript:void(0)" class="button button--outline choose-package-btn" style="background-color: #fff;" disabled>{{$package2->button_title ?? 'Choose Basic'}}</a>
                    </div>
                </div>
                <div class="package">
                    <div class="package__header">
                    <a href="{{ route('packages.edit', ['id' => 3]) }}" class="btn btn-success mb-2">Edit</a>
                        <h2 class="package__title">{{$package3->title ?? 'Basic'}}</h2>
                        <p class="package__description text-center">{{ $package3->content ?? 'Perfect for individual property owners'}}</p>
                    </div>
                    <div class="package__content">
                        <p class="package__price">&#8377; {{$package3->price ?? '1500'}}<span
                                class="package__price-suffix text-dark fw-bold"></span></p>
                        <ul class="package__features">
                            <!-- Display Price Type dynamically -->
                            @if(isset($package3->no_property_listing))
                            <li class="package__feature">{{ $package3->no_property_listing ?? ''  }} property listing</li>

                            @endif

                            <!-- Display property_visibility_days if not null -->
                            @if(isset($package3->property_visibility_days))
                            <li class="package__feature">{{ $package3->property_visibility_days ?? ''  }} days visibility</li>

                            @endif

                            <!-- Display upto_images if not null -->
                            @if(isset($package3->upto_images))
                            <li class="package__feature">  Upto {{ $package3->upto_images ?? ''  }} photos</li>


                            @endif

                            <!-- Display upto_video if not null -->
                            @if(isset($package3->upto_video))
                            <li class="package__feature"> Upto {{ $package3->upto_video ?? '' }} Videos</li>

                            @endif

                            <!-- Display future_listing_days if not null -->
                            @if(isset($package3->future_listing_days))
                            <li class="package__feature">{{ $package3->future_listing_days ?? '' }} Featured listing days</li>

                            @endif

                            <!-- Display 'extra features' dynamically from package -->
                            @foreach($package3->extra_features as $feature)
                            <li class="package__feature">{{ $feature }}</li>
                            @endforeach
                            <!-- Display 'not included' features dynamically from package -->
                            @foreach($package3->not_included as $feature)
                            <li class="package__feature package__feature--not-included">{{ $feature }}</li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="package__footer">
                        <a href="javascript:void(0)" class="button button--outline choose-package-btn" style="background-color: #fff;" disabled>{{$package3->button_title ?? 'Choose Basic'}}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>