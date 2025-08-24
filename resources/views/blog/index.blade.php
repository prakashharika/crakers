<x-app-layout>
    <style>
        .blog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .blog-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .blog-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
        }
        
        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .blog-content {
            padding: 20px;
        }
        
        .blog-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .blog-excerpt {
            color: #666;
            margin-bottom: 15px;
        }
        
        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 0.875rem;
            color: #888;
        }
        
        .create-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004AAD;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
            text-decoration: none;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="blog-container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">Blog Posts</h4>
                <a href="{{ route('blog.create') }}" class="create-btn">Create New Post</a>
            </div>

            @if (session('success'))
                <script>
                    Toastify({
                        text: "{{ session('success') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",
                        stopOnFocus: true,
                    }).showToast();
                </script>
            @endif

            <div class="blog-grid">
                @foreach($posts as $post)
                <div class="blog-card">
                   <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="blog-image">
                    <div class="blog-content">
                        <h3 class="blog-title">{{ $post->title }}</h3>
                        <p class="blog-excerpt">{{ Str::limit($post->excerpt, 100) }}</p>
                        <div class="blog-meta">
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}">Read More →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>
</x-app-layout>