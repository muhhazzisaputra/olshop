@extends('layouts.main')

@section('content')
	<div class="container-fluid pt-5">
        <div class="row justify-content-center px-xl-5 pb-3">
            <div class="col-md-6">
                <form action="/posts">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{request('category')}}">
                    @endif
                    @if(request('author'))
                        <input type="hidden" name="author" value="{{request('author')}}">
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Search post.." value="{{request('search')}}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if($posts->count())
        <div class="row">
            <div class="col-lg-12 col-md-6 pb-1">
                <div class="card mb-3">
                    <img src="{{ asset('eshopper/img/carousel-1.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body text-center">
                        <h3 class="card-title">{{$posts[0]->title}}</h3>
                        <p>
                            <small class="text-muted">By <a href="/posts?author={{$posts[0]->author->username}}" class="text-decoration-none">{{$posts[0]->author->name}}</a> in <a href="?category={{$posts[0]->category->slug}}" class="text-decoration-none">{{$posts[0]->category->name}}</a> {{$posts[0]->created_at->diffForHumans()}}</small>
                        </p>

                        <p class="card-text">{{$posts[0]->excerpt}}</p>

                        <a href="/posts/{{$posts[0]->slug}}" class="text-decoration-none btn btn-primary">Read more..</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7);"><a href="?category={{$post->category->slug}}" class="text-decoration-none">{{$post->category->name}}</a></div>
                    <img src="https://source.unsplash.com/500x400?{{$post->category->name}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p>
                            <small class="text-muted">By <a href="/posts?author={{$post->author->username}}" class="text-decoration-none">{{$post->author->name}}</a> {{$post->created_at->diffForHumans()}}</small>
                        </p>
                        <p class="card-text">{{$post->excerpt}}</p>
                        <a href="/posts/{{$post->slug}}" class="btn btn-primary">Read more..</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
            <p class="text-center">No post found.</p>
        @endif
        <div class="d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
@endsection