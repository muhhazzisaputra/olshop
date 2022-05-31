@extends('admin.layouts.main')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Post Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/adminpost">Post</a></li>
          <li class="breadcrumb-item active">Post Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Form Post Edit</h3>
      </div>
      <form action="/adminpost/{{ $post->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="image">Post Image</label>
                <input type="hidden" name="old_image" value="{{ $post->image }}">
                @if($post->image)
                  <img src="{{ asset('storage/'.$post->image) }}"class="img-preview img-fluid mb-3 col-sm-6 d-block">
                @else
                  <img class="img-preview img-fluid mb-3 col-sm-6">
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" onchange="previewImg()">
                @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter title" value="{{ old('title', $post->title) }}" required autofocus>
                @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="slug">Slug <span style="color: red;">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Enter slug" value="{{ old('slug', $post->slug) }}" required>
                @error('slug')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label>Category <span style="color: red;">*</span></label>
                <select class="form-control" name="category_id">
                  @foreach($categories as $category)
                    @if(old('category_id', $post->category_id) == $category->id)
                      <option value="{{ $category->id }}" selected>x{{ $category->name }}</option>
                    @else
                      <option value="{{ $category->id }}">x{{ $category->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Body <span style="color: red;">*</span></label>
                @error('body')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
                <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}" required>
                <trix-editor input="body"></trix-editor>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
  const title = document.querySelector('#title');
  const slug  = document.querySelector('#slug');

  title.addEventListener('change', function() {
    fetch('/adminpost/getSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
  });

  function previewImg() {
    const image      = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    };
  }
</script>
@endsection