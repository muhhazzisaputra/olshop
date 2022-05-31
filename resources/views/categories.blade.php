@extends('layouts.main')

@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-12 col-md-6 pb-1">
                <h1>Post Categories</h1>
                @foreach($categories as $category)
                <ul>
                    <li>
                        <h2><a href="/categories/{{$category->slug}}">{{$category->name}}</a></h2>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection