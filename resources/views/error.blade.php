<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>
<h2>{{ $message ?? 'Произошла ошибка' }}</h2>
<a href="{{ url()->previous(url('/')) }}">Назад</a>
</body>
</html>
