@extends('frontend.auth.layouts.master')

@section('login-content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Login to application</p>
        @include('frontend.auth.layouts.errors')
        <form action="{{ url('/login') }}" method="post" enctype="multipart/form-data" id="login-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <label id="email-error" class="error col-12" for="email"></label>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <label id="password-error" class="error col-12" for="password"></label>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
            <a href="{{ url('/forgot-password') }}">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="{{ url('register') }}" class="text-center">Register a new membership</a>
        </p>
    </div>
@endsection

@section('custom-js')
    <script>
        $("#login-form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "email": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength: 8
                },
            },
            messages: {
                "email": {
                    required: "Please enter email",
                },
                "password": {
                    required: "Please enter password",
                    minlength: "Please enter at least 8 characters"
                },
            }
        });
    </script>
@endsection
