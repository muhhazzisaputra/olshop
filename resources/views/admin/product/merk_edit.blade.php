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
                    <li class="breadcrumb-item"><a href="/adminpost">Merek Produk</a></li>
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
      <form action="/admin/merk/{{ $merk->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="logo">Logo Merek</label>
                        <input type="hidden" name="old_image" value="{{ $merk->logo }}">
                        @if($merk->logo)
                          <img src="{{ asset('storage/'.$merk->logo) }}"class="img-preview img-fluid mb-3 col-sm-6 d-block">
                        @else
                          <img class="img-preview img-fluid mb-3 col-sm-6">
                        @endif
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" onchange="previewImg()">
                        @error('logo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Merek <span style="color: red;">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Merek" value="{{ $merk->name }}" required autofocus>
                        @error('name')
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
  function previewImg() {
    const logo      = document.querySelector('#logo');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(logo.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    };
  }
</script>
@endsection