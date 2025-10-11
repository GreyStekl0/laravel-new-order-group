<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regions</title>
</head>
<body>
<h2>Список участков для голосования</h2>
<table border="1">
    <thead>
    <td>id</td>
    <td>Регион</td>
    <td>Номер участка</td>
    <td>Количество голосующих</td>
    <td>Действия</td>
    </thead>
    <tbody>
    @foreach($pollingStations as $station)
        <tr>
            <td>{{ $station->id }}</td>
            <td>{{ $station->region->name }}</td>
            <td>{{ $station->stage_number }}</td>
            <td>{{ $station->number_of_voters }}</td>
            <td><a href="{{ url('pollingstation/destroy', $station->id) }}">Удалить</a>
                <a href="{{ url('pollingstation/edit', $station->id) }}">Редактировать</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
