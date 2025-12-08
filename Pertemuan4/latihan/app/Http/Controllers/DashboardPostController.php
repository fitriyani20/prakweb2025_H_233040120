<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id());

        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('dashboard.index', [
            'posts' => $posts->latest()->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'excerpt'     => 'required',
            'body'        => 'required',
        ]);

        // Generate slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        // Pastikan slug unique
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Simpan post
        Post::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'excerpt'     => $request->excerpt,
            'body'        => $request->body,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validasi
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'excerpt'     => 'required',
            'body'        => 'required',
        ]);

        $data = $request->all();

        // Jika title berubah → update slug
        if ($request->title !== $post->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;

            while (
                Post::where('slug', $slug)
                    ->where('id', '!=', $post->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $data['slug'] = $slug;
        }

        $post->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Post deleted successfully!');
    }
}