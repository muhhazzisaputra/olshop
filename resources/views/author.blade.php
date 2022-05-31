@extends('layouts.main')

@section('content')
	<div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-12 col-md-6 pb-1">
            	@foreach($posts as $post)
            	<article class="mb-5 border-bottom pb-3">
            		<h2><a href="/posts/{{$post->slug}}" class="text-decoration-none">{{$post->title}}</a></h2>

                    <p>By <a href="/authors/{{$post->author->username}}" class="text-decoration-none">{{$post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}" class="text-decoration-none">{{$post->category->name}}</a></p>

            		<p>{{$post->excerpt}}</p>

                    <a href="/posts/{{$post->slug}}" class="text-decoration-none">Read more..</a>
            	</article>
            	@endforeach
            </div>
        </div>
    </div>
@endsection