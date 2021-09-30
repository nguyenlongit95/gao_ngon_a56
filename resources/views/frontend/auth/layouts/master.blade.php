<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BaseApp | Admin log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('frontend.auth.layouts.header')
</head>
<body class="login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
        @yield('login-content')
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@include('frontend.auth.layouts.footer')
<script>

</script>

@yield('custom-js')

</body>
</html>
