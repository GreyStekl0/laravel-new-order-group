<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Polling Station</title>
    <style> .is-invalid {
            color: red;
        } </style>
</head>
<body>
<h2> Редактирование участка для голосования </h2>
<form method="post" action="{{ url('pollingstation/update'.$pollingStation->id) }}">
    @csrf
    <label> ID Региона: </label>
    <select name="region_id">
        <option value="">Выберите регион</option>
        @foreach($regions as $region)
            <option value="{{ $region->id }}"
                    @if(old('region_id'))
                        @if(old('region_id') == $region->id) selected @endif
                    @else
                        @if($pollingStation->region_id == $region->id) selected @endif
                @endif>
                {{ $region->name }}
            </option>
        @endforeach
    </select>
    @error('region_id')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label> Номер участка </label>
    <input type="number" name="stage_number"
           value="@if(old('stage_number')) {{ old('stage_number') }} @else{{ $pollingStation->stage_number }}@endif">
    @error('stage_number')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label> Количество голосующих </label>
    <input type="number" name="number_of_voters"
           value="@if(old('number_of_voters')) {{ old('number_of_voters') }} @else{{ $pollingStation->number_of_voters }}@endif">
    @error('number_of_voters')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <input type="submit">
</form>
</body>
</html>
