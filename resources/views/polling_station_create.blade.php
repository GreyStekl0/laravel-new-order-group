<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Polling Station</title>
    <style> .is-invalid {
            color: red;
        } </style>
</head>
<body>
<h2> Добавление участка для голосования </h2>
<form method="post" action={{ url('pollingStation') }}>
    @csrf
    <label> ID Региона: </label>
    <select name="region_id" value="{{ old('region_id') }}">
        <option style="">
        @foreach($regions as $region)
            <option value="{{ $region -> id }}"
                    @if(old('region_id') == $region -> id) selected
                @endif>{{ $region -> name }}
            </option>
        @endforeach
    </select>
    @error('region_id')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label> Номер участка </label>
    <input type="text" name="stage_number" value="{{ old('stage_number') }}">
    @error('stage_number')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label> Количество голосующих </label>
    <input type="text" name="number_of_voters" value="{{ old('number_of_voters') }}">
    @error('number_of_voters')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <input type="submit">
</form>
</body>
</html>
