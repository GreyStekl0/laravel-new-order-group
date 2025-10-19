<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>403 - Доступ запрещён</title>
</head>
<body>
<h2>{{ $exception->getMessage() ?? 'Произошла ошибка' }}</h2>
<a href="{{ url()->previous(url('/')) }}">Назад</a>
</body>
</html>
