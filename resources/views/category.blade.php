@extends('layouts.main')

@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-12 col-md-6 pb-1">
                <h1>Post Category : {{$category}}</h1>
                @foreach($posts as $post)
                <article>
                    <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
                    <p>{{$post->excerpt}}</p>
                </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection