<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', ['post' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'تم إنشاء المقال');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request, $post->id);
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'تم تحديث المقال');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'تم حذف المقال');
    }

    private function validated(Request $request, ?int $exceptId = null): array
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $slug = Str::slug($request->title);
        $base = $slug;
        $i    = 1;
        while (Post::where('slug', $slug)->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return [
            'title'            => $request->title,
            'slug'             => $slug,
            'content'          => $request->content,
            'excerpt'          => $request->excerpt,
            'meta_description' => $request->meta_description,
            'is_published'     => $request->boolean('is_published'),
            'published_at'     => $request->boolean('is_published') ? now() : null,
        ];
    }
}
