<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Участки для голосования</title>
</head>
<body>
<h2>Список участков для голосования</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Регион</th>
        <th>Номер участка</th>
        <th>Количество голосующих</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @forelse($pollingStations as $station)
        <tr>
            <td>{{ $station->id }}</td>
            <td>{{ $station->region->name }}</td>
            <td>{{ $station->stage_number }}</td>
            <td>{{ $station->number_of_voters }}</td>
            <td>
                <a href="{{ route('pollingStation.show', $station->id) }}">Просмотр</a>
                <a href="{{ route('pollingStation.edit', $station->id) }}">Редактировать</a>
                <a href="{{ route('pollingStation.destroy', $station->id) }}">Удалить</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Нет участков для отображения</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>
