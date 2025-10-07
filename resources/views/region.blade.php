<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Region</title>
</head>
<body>
<h2>{{$region ? "Список участков для голосования в регионе ".$region->name : 'Неверный ID региона'}}</h2>
@if($region)
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Номер участка</th>
            <th>Количество голосующих</th>
        </tr>
        </thead>
        <tbody>
        @foreach($region->pollingStations as $station)
            <tr>
                <td>{{ $station->id }}</td>
                <td>{{ $station->stage_number }}</td>
                <td>{{ $station->number_of_voters }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>
