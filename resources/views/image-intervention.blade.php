<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Intervention Image Upload Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-4">

  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="card">

    <div class="card-header text-center font-weight-bold">
      <h2>Laravel 8 Intervention Image Upload Example</h2>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="intervention-image-upload" action="{{ url('upload') }}" >
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        @error('name')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                  
                <div class="col-md-12 mb-2">
                    <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 250px;">
                </div>
                  
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>     
        </form>
    </div>

  </div>
</div>  
</body>
</html>