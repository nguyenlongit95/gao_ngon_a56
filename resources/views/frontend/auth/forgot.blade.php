@extends('frontend.auth.layouts.master')

@section('login-content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Forgot your password!</p>
        @include('frontend.auth.layouts.errors')
        <form action="{{ url('/forgot-password') }}" method="post" enctype="multipart/form-data" id="register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Your email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <label id="email-error" class="error col-12" for="email"></label>
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
                <div class="col-7"></div>
                <!-- /.col -->
                <div class="col-5">
                    <button id="btn-submit-forgot" type="submit" disabled="disabled" class="btn btn-primary btn-block">Send email</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

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
                "email": {
                    required: true,
                },
            },
            messages: {
                "email": {
                    required: "Please enter email",
                },
            }
        });
        $(document).ready(function () {
            $('#remember').on('click', function () {
                let _accept = $('#remember').is(":checked");
                if (_accept === true) {
                    $('#btn-submit-forgot').removeAttr('disabled');
                }
                if (_accept === false) {
                    $('#btn-submit-forgot').attr('disabled', 'disabled');
                }
            });
        });
    </script>
@endsection
