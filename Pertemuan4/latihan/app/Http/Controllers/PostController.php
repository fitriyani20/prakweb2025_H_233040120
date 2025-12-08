<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
      $posts = Post::all(); 
      return view('posts', compact('posts'));
    }

    //Route Model binding untuk single post page
    public function show(Post $post)
    {
      //Menggunakan with() untuk mengatasi N+1 Plroblem
      $post->load(['author', 'category']);
      return view('post', compact('post'));
    }

}