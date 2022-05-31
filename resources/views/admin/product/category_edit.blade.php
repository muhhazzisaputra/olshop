@extends('admin.layouts.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/category">Kategori Produk</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data</h3>
            </div>
            <form action="/admin/category/{{ $category->slug }}" method="post">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Nama Kategori <span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name" value="{{ old('name', $category->name) }}" required autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug <span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Enter slug" value="{{ old('slug', $category->slug) }}" required>
                            @error('slug')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
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
  const name = document.querySelector('#name');
  const slug = document.querySelector('#slug');

  name.addEventListener('change', function() {
    fetch('/admin/category/getSlug?name=' + name.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  });
</script>
@endsection