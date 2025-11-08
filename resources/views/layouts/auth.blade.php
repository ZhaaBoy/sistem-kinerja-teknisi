<!doctype html>
<html lang="en" data-theme="light" dir="ltr" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Login')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('template/assets/dist/css/output.css') }}" />

    <script src="{{ asset('template/assets/dist/js/theme-utils.js') }}"></script>
    <script src="{{ asset('template/assets/dist/libs/flyonui/flyonui.js') }}"></script>
    <script src="{{ asset('template/assets/dist/js/main.js') }}"></script>
</head>

<body>
    @yield('content')
</body>

</html>
