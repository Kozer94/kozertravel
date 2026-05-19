<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('is_active', true)->get(['slug', 'updated_at']);
        $posts        = Post::published()->get(['slug', 'published_at']);

        return response()->view('sitemap', compact('destinations', 'posts'))
            ->header('Content-Type', 'application/xml');
    }
}
