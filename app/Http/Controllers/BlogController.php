<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('published', true)
                        ->orderBy('published_at', 'desc')
                        ->paginate(6);
                        
        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('blog.create');
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'excerpt' => 'nullable|max:500',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'images/' . $imageName;
        
        // Move the image to the public/images directory
        $image->move(public_path('images'), $imageName);
    }

    BlogPost::create([
        'title' => $request->title,
        'slug' => \Illuminate\Support\Str::slug($request->title),
        'excerpt' => $request->excerpt,
        'content' => $request->content,
        'image' => $imagePath,
        'published' => $request->has('published'),
        'published_at' => $request->has('published') ? now() : null,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('blog.index')
        ->with('success', 'Blog post created successfully.');
}

public function update(Request $request, BlogPost $blogPost)
{
    $request->validate([
        'title' => 'required|max:255',
        'excerpt' => 'nullable|max:500',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($blogPost->image && file_exists(public_path($blogPost->image))) {
            unlink(public_path($blogPost->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'images/' . $imageName;
        
        // Move the image to the public/images directory
        $image->move(public_path('images'), $imageName);
        $blogPost->image = $imagePath;
    }

    $blogPost->title = $request->title;
    $blogPost->excerpt = $request->excerpt;
    $blogPost->content = $request->content;
    $blogPost->published = $request->has('published');
    $blogPost->published_at = $request->has('published') ? now() : null;
    $blogPost->save();

    return redirect()->route('blog.index')
        ->with('success', 'Blog post updated successfully.');
}

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
                        ->where('published', true)
                        ->firstOrFail();
                        
        return view('blog.show', compact('post'));
    }

    public function edit(BlogPost $blogPost)
    {
        return view('blog.create', compact('blogPost'));
    }

public function destroy(BlogPost $blogPost)
{
    // Delete the image file if exists
    if ($blogPost->image && file_exists(public_path($blogPost->image))) {
        unlink(public_path($blogPost->image));
    }
    
    $blogPost->delete();

    return redirect()->route('blog.index')
        ->with('success', 'Blog post deleted successfully.');
}
}