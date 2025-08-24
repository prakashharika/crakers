<x-app-layout>
    <style>
        .blog-detail-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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
        }
        
        .blog-detail-content h2 {
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .blog-detail-content p {
            margin-bottom: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        
        .btn-edit, .btn-back {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-edit {
            background-color: #004AAD;
            color: white;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .blog-detail-container {
    background: #fff;
}
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="blog-detail-container">
            <a href="{{ route('blog.index') }}" class="btn-back">← Back to Blog</a>
            
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="blog-detail-image">
            
            <h1 class="blog-detail-title">{{ $post->title }}</h1>
            
            <div class="blog-detail-meta">
                <span>Published: {{ $post->published_at->format('F j, Y') }}</span>
                <span>By: {{ $post->user->name }}</span>
            </div>
            
            @if($post->excerpt)
            <div class="blog-excerpt" style="font-style: italic; margin-bottom: 20px;">
                {{ $post->excerpt }}
            </div>
            @endif
            
            <div class="blog-detail-content">
                {!! $post->content !!}
            </div>
            
            @auth
            <div class="action-buttons">
                <a href="{{ route('blog.edit', $post) }}" class="btn-edit">Edit Post</a>
            </div>
            @endauth
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>
</x-app-layout>