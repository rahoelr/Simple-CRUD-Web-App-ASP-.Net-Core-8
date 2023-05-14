<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BUMDES SITE | Admin {{ $title }}</title>
    <link rel="shortcut icon" href="{{asset("img/Logo.png")}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('lightbox/dist/css/lightbox.min.css')}}">
    <link href="{{ asset("template_1/style/main.css") }}" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            @if (Auth::user()->level == 'admin')
            @include('partials.admin_sidebar')
            @else
            @include('partials.mitra_sidebar')
            @endif
            @if (Auth::user()->level == 'admin')
            @yield('content')
            @else
            @yield('mitra')
            @endif
        </div>
    </div>

    <script src="{{asset("template_1/vendor/jquery/jquery.slim.min.js")}}"></script>
    <script src="{{asset("template_1/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{ asset('lightbox/dist/js/lightbox-plus-jquery.min.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    </script>
    <script src="https://kit.fontawesome.com/8b03b562bf.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
