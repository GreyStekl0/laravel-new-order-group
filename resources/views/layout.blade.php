<!doctype html>
<html lang="ru" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title', 'Выборы выборы, кандидаты...')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="d-flex flex-column min-vh-100">

<main class="flex-grow-1">
    @yield('content')
</main>

@includeWhen(session('success'), 'notification')

@include('footer')
@stack('body-end')
</body>
</html>
