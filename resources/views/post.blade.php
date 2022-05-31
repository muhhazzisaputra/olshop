@extends('layouts.main')

@section('content')
	<div class="container-fluid pt-2">
        <div class="row justify-content-center px-xl-5 pb-3">
            <div class="col-lg-8 col-md-6 pb-1">
            	<h1>{{$post->title}}</h1>
                <p>
                    By <a href="/authors/{{$post->author->username}}" class="text-decoration-none">{{$post->author->name}}</a> in <a href="/posts?category={{$post->category->slug}}" class="text-decoration-none">{{$post->category->name}}</a>
                </p>
                <img src="https://source.unsplash.com/1200x400?{{$post->category->name}}" class="img-fluid">

                <article class="my-3">
                    {!!$post->body!!}
                </article>

                <a href="/posts" class="d-block mt-3 text-decoration-none">Back to posts</a>
            </div>
        </div>
    </div>
@endsection