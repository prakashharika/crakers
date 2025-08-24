@extends('layouts.main')

@section('content')
    <style>
        .blog-list-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .blog-list-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .blog-list-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .blog-list-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .blog-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .blog-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .blog-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .blog-card:hover .blog-card-image {
            transform: scale(1.05);
        }
        
        .blog-card-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .blog-card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
            display: block;
            font-weight: 600;
            line-height: 1.4;
        }
        
        .blog-card-title:hover {
            color: #004AAD;
        }
        
        .blog-card-excerpt {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .blog-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 0.875rem;
            color: #888;
        }
        
        .blog-card-date {
            font-size: 0.8rem;
        }
        
        .read-more-link {
            color: #004AAD;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .read-more-link:hover {
            text-decoration: underline;
        }
        
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        
        .no-blogs-message {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .no-blogs-message h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        /* Fallback for broken images */
        .blog-image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-family: 'icomoon' !important;
            content: "\e90a"; /* Use your image icon */
            font-size: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .blog-card-image[src=""],
        .blog-card-image:not([src]) {
            opacity: 0;
        }
        
        .blog-card-image[src=""] + ::before,
        .blog-card-image:not([src]) + ::before {
            opacity: 1;
        }
        
        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }
            
            .blog-list-title {
                font-size: 2rem;
            }
            
            .blog-card {
                margin-bottom: 20px;
            }
            
            .blog-image-container {
                height: 180px;
            }
        }
    </style>

    <div class="blog-list-container">
        <div class="blog-list-header">
            <h1 class="blog-list-title">Our Blog</h1>
            <p class="blog-list-subtitle">Discover the latest news, tips, and insights from our team</p>
        </div>

        @if($blogs->count() > 0)
            <div class="blog-grid">
                @foreach($blogs as $blog)
                <div class="blog-card">
                    <a href="{{ route('blog-user.show', Str::slug($blog->title)) }}">
                        <div class="blog-image-container">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="blog-card-image" 
                                 onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzUwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjVmN2ZhIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzg4OCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9IjAuMzVlbSI+QmxvZyBJbWFnZTwvdGV4dD48L3N2Zz4='">
                        </div>
                    </a>
                    <div class="blog-card-content">
                        <a href="{{ route('blog-user.show', Str::slug($blog->title)) }}" class="blog-card-title">
                            {{ $blog->title }}
                        </a>
                        <p class="blog-card-excerpt">
                            {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        <div class="blog-card-meta">
                            <span class="blog-card-date">{{ $blog->published_at->format('M j, Y') }}</span>
                            <a href="{{ route('blog-user.show', Str::slug($blog->title)) }}" class="read-more-link">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination-container">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="no-blogs-message">
                <h3>No blog posts yet</h3>
                <p>Check back later for new content!</p>
            </div>
        @endif
    </div>

    <script>
        // JavaScript to handle image loading and errors
        document.addEventListener('DOMContentLoaded', function() {
            const blogImages = document.querySelectorAll('.blog-card-image');
            
            blogImages.forEach(img => {
                // Check if image loaded successfully
                if (img.complete && img.naturalHeight === 0) {
                    img.style.opacity = '0';
                }
                
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
                
                img.addEventListener('error', function() {
                    this.style.opacity = '0';
                    // Fallback image is already set via onerror attribute
                });
            });
        });
    </script>
@endsection