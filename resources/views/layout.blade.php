<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Выборы выборы, кандидаты...')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column h-100">
@yield('content')
@include('footer')
</body>
</html>
