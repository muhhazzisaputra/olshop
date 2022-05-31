@extends('admin.layouts.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tentang Kami</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Tentang Kami</li>
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
            <form action="/admin/page/{{ $page->slug }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Judul <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter title" value="{{ old('title', $page->title) }}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="img">Gambar</label>
                                <input type="hidden" name="old_image" value="{{ $page->img }}">
                                @if($page->img)
                                  <img src="{{ asset('storage/'.$page->img) }}"class="img-preview img-fluid mb-3 col-sm-6 d-block">
                                @else
                                  <img class="img-preview img-fluid mb-3 col-sm-6">
                                @endif
                                <input type="file" name="img" class="form-control @error('img') is-invalid @enderror" id="img" onchange="previewImg()">
                                @error('img')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Isi Halaman <span style="color: red;">*</span></label>
                                @error('content')
                                  <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="hidden" name="content" id="content" value="{{ old('content', $page->content) }}" required>
                                <trix-editor input="content"></trix-editor>
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
        const img        = document.querySelector('#img');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>

@endsection