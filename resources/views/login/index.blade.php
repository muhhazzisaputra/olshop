@extends('layouts.mainV1')

@section('content')
	<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-3">
        <div class="row justify-content-center px-xl-5">
            <div class="col-lg-6 mb-3">
                <div class="contact-form">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action="/login" method="post" id="login-form">
                        @csrf
                        <div class="control-group">
                            <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" value="{{old('email')}}"required autofocus>
                            @error('email')
                            <p class="help-block text-danger">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" required>
                             @error('password')
                            <p class="help-block text-danger">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Login</button>
                        </div>
                    </form>
                    <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <p class="text-center mt-3">Not Registered? <a href="/register" class="text-decoration-none">Register Now!</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection