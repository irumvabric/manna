<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', true)->latest()->paginate(9);
        return view('pages.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', true)->firstOrFail();
        $recentBlogs = Blog::where('status', true)->where('id', '!=', $blog->id)->latest()->take(3)->get();
        return view('pages.blog.show', compact('blog', 'recentBlogs'));
    }
}
