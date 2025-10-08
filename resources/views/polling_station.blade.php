<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Polling station</title>
</head>
<body>
<h2>{{$pollingStation ? "Список кандидатов на участке № ".$pollingStation->id : 'Неверный ID участка для голосования'}}</h2>
@if($pollingStation)
    <table border="1">
        <thead>
        <tr>
            <th>id</th>
            <th>Полное ФИО</th>
            <th>Количество голосов</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pollingStation->candidates as $candidate)
            <tr>
                <td>{{ $candidate->id }}</td>
                <td>{{ $candidate->name }}</td>
                <td>{{ $candidate->pivot->number_of_voters }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>{{"Итого голосов: ".$total->total}}</h2>
@endif
</body>
</html>
