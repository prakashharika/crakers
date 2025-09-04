@extends('layouts.main')

@section('content')
<div class="container py-5">
    <h2 class="mb-5 text-center fw-bold">Browse Our Categories</h2>

    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm category-card">
                    
                    {{-- Clickable image --}}
                    <a href="{{ url('/category/' . $category->slug) }}">
                        <img src="{{ asset($category->image) }}" 
                             class="card-img-top img-fluid category-image" 
                             alt="{{ $category->name }}">
                    </a>

                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $category->name }}</h5>
                        <p class="card-text text-muted mb-4">
                            {{ Str::limit($category->description, 80, '...') }}
                        </p>

                        {{-- View Products Button --}}
                        <a href="{{ url('/category/' . $category->slug) }}" 
                           class="btn btn-primary mt-auto rounded-pill px-4">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No categories available.</p>
        @endforelse
    </div>
</div>

{{-- Custom CSS --}}
@push('styles')
<style>
    .category-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .category-image {
        height: 220px;
        object-fit: cover;
    }
    .btn-primary {
        background: linear-gradient(90deg, #007bff, #0056b3);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #0056b3, #004085);
    }
</style>
@endpush
@endsection
