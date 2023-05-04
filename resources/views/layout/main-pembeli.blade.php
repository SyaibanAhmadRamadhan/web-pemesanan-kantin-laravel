<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kantin | {{ $title }}</title>

    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <!-- Swipper JS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>

<body>
    @yield('container')
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> --}}

    <!-- Swipper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- My JS -->
    @if ($title == 'menu')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
    @endif
</body>

</html>
