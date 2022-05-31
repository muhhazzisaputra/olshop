<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{

    public function index()
    {
        return view('admin.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function create()
    {
        return view('admin/post/create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'image'       => 'image|file|max:1024',
            'title'       => 'required|max:100',
            'slug'        => 'required|unique:posts',
            'category_id' => 'required',
            'body'        => 'required'
        ]);

        if($request->file('image')) {
            $validate_data['image'] = $request->file('image')->store('post-images');
        }

        $validate_data['user_id'] = auth()->user()->id;
        $validate_data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::create($validate_data);

        return redirect('/adminpost')->with('success', 'New post has been created.'); 
    }

    public function show(Post $adminpost)
    {
        return view('admin.post.show', [
            'post' => $adminpost
        ]);
    }

    public function edit(Post $adminpost)
    {
        return view('admin/post/edit', [
            'post'       => $adminpost,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $adminpost)
    {
        $rules = [
            'image'       => 'image|file|max:1024',
            'title'       => 'required|max:100',
            'category_id' => 'required',
            'body'        => 'required'
        ];

        if($request->slug != $adminpost->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validate_data = $request->validate($rules);

        if($request->file('image')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validate_data['image'] = $request->file('image')->store('post-images');
        }

        $validate_data['user_id'] = auth()->user()->id;
        $validate_data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::where('id', $adminpost->id)->update($validate_data);

        return redirect('/adminpost')->with('success', 'Post has been updated.');
    }

    public function destroy(Post $adminpost)
    {
        if($adminpost->image) {
            Storage::delete($adminpost->image);
        }

        Post::destroy($adminpost->id);

        return redirect('/adminpost')->with('success', 'Post has been deleted.');
    }

    public function getSlug(Request $request)
    {
        return $request;
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
