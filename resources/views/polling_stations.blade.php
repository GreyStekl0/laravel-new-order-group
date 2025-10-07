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
    <td>id региона</td>
    <td>Номер участка</td>
    <td>количество голосующих</td>
    </thead>
    <tbody>
    @foreach($pollingStations as $station)
        <tr>
            <td>{{ $station->id }}</td>
            <td>{{ $station->region_id }}</td>
            <td>{{ $station->stage_number }}</td>
            <td>{{ $station->number_of_voters }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
