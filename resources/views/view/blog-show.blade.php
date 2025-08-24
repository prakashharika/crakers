@extends('layouts.main')

@section('content')
    <style>
        .blog-container {
            display: flex;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .blog-main-content {
            flex: 1;
            max-width: 800px;
        }
        
        .blog-sidebar {
            width: 300px;
            flex-shrink: 0;
        }
        
        .blog-detail-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .blog-detail-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .blog-detail-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .blog-detail-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
            margin-top: 30px;
        }
        
        .blog-detail-content h2 {
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .blog-detail-content p {
            margin-bottom: 20px;
        }
        
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004AAD;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
            text-decoration: none;
        }
        
        /* Sidebar styles */
        .sidebar-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #004AAD;
            color: #333;
        }
        
        .sidebar-blog-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-blog-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .sidebar-blog-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .sidebar-blog-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .sidebar-blog-title {
            font-size: 1rem;
            margin-bottom: 5px;
            color: #333;
            text-decoration: none;
            display: block;
            font-weight: 600;
        }
        
        .sidebar-blog-title:hover {
            color: #004AAD;
        }
        
        .sidebar-blog-date {
            font-size: 0.8rem;
            color: #666;
        }
        
        .no-blogs-sidebar {
            color: #666;
            font-style: italic;
        }
        
        @media (max-width: 992px) {
            .blog-container {
                flex-direction: column;
            }
            
            .blog-sidebar {
                width: 100%;
                order: -1;
            }
            
            .blog-main-content {
                max-width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .blog-detail-title {
                font-size: 2rem;
            }
            
            .blog-detail-image {
                height: 300px;
            }
            
            .sidebar-title {
                font-size: 1.3rem;
            }
        }
        
        /* Social sharing buttons */
        .social-share {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .share-title {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #666;
        }
        
        .share-buttons {
            display: flex;
            gap: 10px;
        }
        
        .share-button {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .facebook { background-color: #3b5998; }
        .twitter { background-color: #1da1f2; }
        .linkedin { background-color: #0077b5; }
        .whatsapp { background-color: #25d366; }
    </style>

    <div class="blog-container">
        <div class="blog-main-content">
            <a href="{{ url('/') }}" class="back-button">← Back to Home</a>
            
            <img src="{{ asset($blogpost->image) }}" alt="{{ $blogpost->title }}" class="blog-detail-image">
            
            <h1 class="blog-detail-title">{{ $blogpost->title }}</h1>
            
            <div class="blog-detail-meta">
                <span>Published: {{ $blogpost->published_at->format('F j, Y') }}</span>
                <span>By: Admin</span>
            </div>
            
            @if($blogpost->excerpt)
            <div class="blog-excerpt" style="font-style: italic; margin-bottom: 20px; font-size: 1.2rem;">
                {{ $blogpost->excerpt }}
            </div>
            @endif
            
            <div class="blog-detail-content">
                {!! $blogpost->content !!}
            </div>
            
            <div class="social-share">
                <div class="share-title">Share this post:</div>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" class="share-button facebook"><i class="icon-fb"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blogpost->title) }}&url={{ urlencode(url()->current()) }}" 
                       target="_blank" class="share-button twitter"><i class="icon-x"></i></a>
                    {{-- <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blogpost->title) }}" 
                       target="_blank" class="share-button linkedin"><i class="icon-linked-in"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($blogpost->title . ' ' . url()->current()) }}" 
                       target="_blank" class="share-button whatsapp"><i class="icon-wa"></i></a> --}}
                </div>
            </div>
        </div>
        
        <div class="blog-sidebar">
            <h3 class="sidebar-title">Recent Posts</h3>
            
            @if($recentBlogs->count() > 0)
            <ul class="sidebar-blog-list">
                @foreach($recentBlogs as $recentBlog)
                <li class="sidebar-blog-item">
                    <a href="{{ route('blog-user.show', Str::slug($recentBlog->title)) }}">
                        <img src="{{ asset($recentBlog->image) }}" alt="{{ $recentBlog->title }}" class="sidebar-blog-image">
                    </a>
                    <a href="{{ route('blog-user.show', Str::slug($recentBlog->title)) }}" class="sidebar-blog-title">
                        {{ $recentBlog->title }}
                    </a>
                    <div class="sidebar-blog-date">
                        {{ $recentBlog->published_at->format('M j, Y') }}
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="no-blogs-sidebar">No other blog posts available.</p>
            @endif
            
           
        </div>
    </div>
@endsection