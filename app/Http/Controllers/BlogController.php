<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = BlogPost::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(BlogPost $post)
    {
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        // Increment view count
        $post->increment('views');

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category($category)
    {
        $posts = BlogPost::published()
            ->byCategory($category)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = BlogPost::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog.category', compact('posts', 'categories', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $posts = BlogPost::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = BlogPost::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog.search', compact('posts', 'categories', 'query'));
    }
} 