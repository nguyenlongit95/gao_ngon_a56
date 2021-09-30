@extends('frontend.auth.layouts.master')

@section('login-content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Register new account</p>
        @include('frontend.auth.layouts.errors')
        <form action="{{ url('/register') }}" method="post" enctype="multipart/form-data" id="register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Your name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <label id="name-error" class="error col-12" for="name"></label>
            </div>
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
                <div class="col-12">
                    <div class="icheck-primary">
                        <input type="checkbox" class="accept-checkbox" id="remember">
                        <label for="remember" class="font-size-13">
                            I agree with the business agreements
                        </label>
                    </div>
                </div>
                <div class="col-8"></div>
                <!-- /.col -->
                <div class="col-4">
                    <button id="btn-submit-register" type="submit" disabled="disabled" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Register using Facebook
            </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-0">
            I already have an account, click<a href="{{ url('login') }}" class="text-center"> here</a> to return to the login page
        </p>
    </div>
@endsection

@section('custom-js')
    <script>
        $("#register-form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "name": {
                    required: true,
                    minlength: 3
                },
                "email": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength: 8
                },
            },
            messages: {
                "name": {
                    required: "What your name?",
                    minlength: "Please enter at least 3 characters"
                },
                "email": {
                    required: "Please enter email",
                },
                "password": {
                    required: "Please enter password",
                    minlength: "Please enter at least 8 characters"
                },
            }
        });
        $(document).ready(function () {
            $('#remember').on('click', function () {
                let _accept = $('#remember').is(":checked");
                if (_accept === true) {
                    $('#btn-submit-register').removeAttr('disabled');
                }
                if (_accept === false) {
                    $('#btn-submit-register').attr('disabled', 'disabled');
                }
            });

        });
    </script>
@endsection
