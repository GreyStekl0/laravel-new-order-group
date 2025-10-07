<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regions</title>
</head>
<body>
<h2>Список регионов</h2>
<table border="1">
    <thead>
    <td>id</td>
    <td>Наименование</td>
    </thead>
    @foreach($regions as $region)
        <tr>
            <td>{{ $region->id }}</td>
            <td>{{ $region->name }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
