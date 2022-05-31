@extends('admin.layouts.main')

@section('content')

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<style>
  trix-toolbar [data-trix-button-group="file-tools"] {
    display: none;
  }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/product">Data Produk</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
            </div>
            <form action="/admin/product" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Gambar Utama Produk</label>
                                <!-- <img class="img-preview img-fluid mb-3 col-sm-6"> -->
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Slug" value="{{ old('slug') }}" required>
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="weight">Berat Produk(gram) <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" placeholder="Berat Produk" value="{{ old('weight') }}" required>
                                @error('weight')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="purchase_price">Harga Beli <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" id="purchase_price" placeholder="Harga Beli" value="{{ old('purchase_price') }}" required>
                                @error('purchase_price')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Produk <span style="color: red;">*</span></label>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="hidden" name="description" id="description" value="{{ old('description') }}" required>
                                <trix-editor input="description"></trix-editor>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Produk <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Produk" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Category <span style="color: red;">*</span></label>
                                <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    @if(old('category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok Produk <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Stok Produk" value="{{ old('stock') }}" required>
                                @error('stock')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="selling_price">Harga Jual <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" id="Harga Jual" placeholder="Harga Jual" value="{{ old('selling_price') }}" required>
                                @error('selling_price')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status Produk <span style="color: red;">*</span></label><br>
                                <div class="icheck-success d-inline">
                                    <input type="radio" name="status" value="1" checked id="radioSuccess1">
                                    <label for="radioSuccess1">Active</label>
                                </div>
                                <div class="icheck-danger d-inline" style="margin-left: 15px;">
                                    <input type="radio" name="status" value="0" id="radioSuccess2">
                                    <label for="radioSuccess2">Disabled</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch('/admin/product/getSlug?name=' + name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });
</script>

@endsection