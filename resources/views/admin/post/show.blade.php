@extends('admin.layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Post</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/adminpost">Post</a></li>
          <li class="breadcrumb-item active">Post Detail</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="container">
	<div class="row my-3">
		<div class="col-lg-8">
			<h1>{{ $post->title }}</h1>
			<a href="/adminpost" class="btn btn-sm btn-info">Back</a>
			<a href="/adminpost/{{ $post->slug }}/edit" class="btn btn-sm btn-warning">Edit</a>
			<form action="/adminpost/{{ $post->slug }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')">Delete</button>
      </form>
      @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
      @else
        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
      @endif
			<article class="my-3 fs-5">
				{!! $post->body !!}
			</article>
			<a href="/adminpost" class="text-decoration-none d-block mt-3">Back to Posts</a>
		</div>
	</div>
</div>
@endsection