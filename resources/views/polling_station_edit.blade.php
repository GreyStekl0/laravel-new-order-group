@extends('layout')

@section('title', 'Редактировать участок №' . $pollingStation->stage_number)

@section('content')
    <section class="bg-body min-vh-100">
        <div class="container py-5 py-lg-6">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-7">

                    {{-- Заголовок --}}
                    <div class="mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('navigation') }}"
                                                               class="text-decoration-none">Навигация</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pollingStation.index') }}"
                                                               class="text-decoration-none">Участки</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('pollingStation.show', $pollingStation->id) }}"
                                        class="text-decoration-none">Участок №{{ $pollingStation->stage_number }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
                            </ol>
                        </nav>
                        <h1 class="display-6 fw-bold mb-2">
                            <i class="fa-solid fa-pen text-danger me-2"></i>
                            Редактировать участок №{{ $pollingStation->stage_number }}
                        </h1>
                        <p class="text-body-secondary mb-0">
                            Внесите необходимые изменения в информацию об участке
                        </p>
                    </div>

                    {{-- Форма --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            <form method="POST" action="{{ route('pollingStation.update', $pollingStation->id) }}"
                                  novalidate>
                                @csrf
                                @method('PATCH')

                                {{-- ID участка (только для отображения) --}}
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fa-solid fa-hashtag text-danger me-2"></i>
                                        ID участка
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg"
                                           value="{{ $pollingStation->id }}"
                                           disabled
                                           readonly>
                                    <div class="form-text">
                                        Идентификатор участка нельзя изменить
                                    </div>
                                </div>

                                {{-- Регион --}}
                                <div class="mb-4">
                                    <label for="region_id" class="form-label">
                                        <i class="fa-solid fa-map-pin text-danger me-2"></i>
                                        Регион <span class="text-danger">*</span>
                                    </label>
                                    <select name="region_id"
                                            id="region_id"
                                            class="form-select form-select-lg @error('region_id') is-invalid @enderror"
                                            required>
                                        <option value="">Выберите регион</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}"
                                                    @if(old('region_id', $pollingStation->region_id) == $region->id) selected @endif>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Выберите регион, в котором расположен участок
                                    </div>
                                </div>

                                {{-- Номер участка --}}
                                <div class="mb-4">
                                    <label for="stage_number" class="form-label">
                                        <i class="fa-solid fa-hashtag text-danger me-2"></i>
                                        Номер участка <span class="text-danger">*</span>
                                    </label>
                                    <input type="number"
                                           name="stage_number"
                                           id="stage_number"
                                           class="form-control form-control-lg @error('stage_number') is-invalid @enderror"
                                           value="{{ old('stage_number', $pollingStation->stage_number) }}"
                                           placeholder="Например: 1234"
                                           min="1"
                                           required>
                                    @error('stage_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Уникальный номер участка в пределах выбранного региона
                                    </div>
                                </div>

                                {{-- Количество избирателей --}}
                                <div class="mb-4">
                                    <label for="number_of_voters" class="form-label">
                                        <i class="fa-solid fa-users text-danger me-2"></i>
                                        Количество избирателей <span class="text-danger">*</span>
                                    </label>
                                    <input type="number"
                                           name="number_of_voters"
                                           id="number_of_voters"
                                           class="form-control form-control-lg @error('number_of_voters') is-invalid @enderror"
                                           value="{{ old('number_of_voters', $pollingStation->number_of_voters) }}"
                                           placeholder="Например: 1500"
                                           min="0"
                                           required>
                                    @error('number_of_voters')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Общее количество зарегистрированных избирателей на участке
                                    </div>
                                </div>

                                {{-- Кнопки --}}
                                <div class="d-flex gap-2 flex-column flex-sm-row">
                                    <button type="submit" class="btn btn-danger btn-lg flex-grow-1">
                                        <i class="fa-solid fa-check me-2"></i> Сохранить изменения
                                    </button>
                                    <a href="{{ url()->previous() }}"
                                       class="btn btn-outline-secondary btn-lg">
                                        <i class="fa-solid fa-xmark me-2"></i> Отмена
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Предупреждение --}}
                    <div class="alert alert-warning d-flex align-items-start mt-4" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-3 mt-1"></i>
                        <div>
                            <strong>Будьте осторожны:</strong> Изменение региона или номера участка может повлиять на
                            связанные данные и отчеты.
                        </div>
                    </div>

                    {{-- Удаление участка --}}
                    <div class="card border-danger mt-4">
                        <div class="card-body p-4">
                            <h4 class="h6 text-danger mb-2">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                Опасная зона
                            </h4>
                            <p class="text-body-secondary small mb-3">
                                Удаление участка приведет к безвозвратной потере всех связанных с ним данных, включая
                                результаты голосования.
                            </p>
                            <form action="{{ route('pollingStation.destroy', $pollingStation->id) }}"
                                  method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Вы уверены, что хотите удалить участок №{{ $pollingStation->stage_number }}?\n\nЭто действие нельзя отменить, и все связанные данные будут потеряны безвозвратно!')">
                                    <i class="fa-solid fa-trash me-2"></i> Удалить участок
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
