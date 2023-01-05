<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="B2E - Multipurpose Ecommerce Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ ucwords(str_replace('.', ' ', request()->route()->getName())) }}
        | {{ strtoupper(config('app.name')) }}</title>
    <!-- CSS Libraries-->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css')}}">
</head>

<body>
<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">

    </div>
</div>
@yield('auth-content')
<!-- All JavaScript Files-->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
@stack('auth-script')
<script>
    // :: Preloader
    $(window).on('load', function () {
        $('#preloader').fadeOut('1000', function () {
            $(this).remove();
        });
    });
</script>
</body>

</html>