@extends('layouts.mainV1')

@section('content')
	<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Register</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Register</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-3">
        <div class="row justify-content-center px-xl-5">
            <div class="col-lg-6 mb-3">
                <div class="contact-form">
                    <form action="/register" method="post" id="register-form">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" id="name" placeholder="Your Name" value="{{old('name')}}" required autofocus>
                            @error('name')
                            <p class="help-block text-danger">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="control-group">
                            <input type="number" class="form-control mb-2 @error('whatsapp') is-invalid @enderror" name="whatsapp" id="whatsapp" placeholder="Your Whatsapp" value="{{old('whatsapp')}}" required>
                            @error('whatsapp')
                            <p class="help-block text-danger">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" value="{{old('email')}}" required>
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
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Register</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Already registered? <a href="/login" class="text-decoration-none">Please Login</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection