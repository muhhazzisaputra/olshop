<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{

    public function index() {
        return view('posts', [
            "title"      => 'All Posts',
            "posts"      => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString(),
            "categories" => Category::all()
        ]);
    }

    public function show(Post $post) {
        return view('post', [
            "title"      => 'Single Post',
            "post"       => $post,
            "categories" => Category::all()
        ]);
    }

}
