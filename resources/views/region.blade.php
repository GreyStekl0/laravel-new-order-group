@extends('layout')

@section('title', $region ? $region->name : 'Регион не найден')

@section('content')
    <section class="bg-body min-vh-100">
        <div class="container py-5 py-lg-6">

            @if($region)
                {{-- Заголовок --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-2">
                                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('navigation') }}" class="text-decoration-none">Навигация</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('region.index') }}" class="text-decoration-none">Регионы</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $region->name }}</li>
                                    </ol>
                                </nav>
                                <h1 class="display-6 fw-bold mb-2">
                                    <i class="fa-solid fa-map-pin text-danger me-2"></i>
                                    {{ $region->name }}
                                </h1>
                                <p class="text-body-secondary mb-0">
                                    Участки для голосования в регионе
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('region.index') }}" class="btn btn-outline-danger">
                                    <i class="fa-solid fa-arrow-left me-2"></i> К списку регионов
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Список участков --}}
                @if($region->pollingStations->isEmpty())
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-5 text-center">
                                    <i class="fa-solid fa-location-dot text-body-tertiary fs-1 mb-3"></i>
                                    <h3 class="h5 mb-2">Участки не найдены</h3>
                                    <p class="text-body-secondary mb-0">
                                        В регионе {{ $region->name }} пока нет участков для голосования
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Карточка со статистикой --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 bg-danger bg-opacity-10">
                                <div class="card-body p-4">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <i class="fa-solid fa-location-dot text-danger fs-3 mb-2"></i>
                                            <div class="h4 mb-1">{{ $region->pollingStations->count() }}</div>
                                            <div class="text-body-secondary small">Участков</div>
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa-solid fa-users text-danger fs-3 mb-2"></i>
                                            <div class="h4 mb-1">{{ number_format($region->pollingStations->sum('number_of_voters')) }}</div>
                                            <div class="text-body-secondary small">Всего избирателей</div>
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa-solid fa-chart-line text-danger fs-3 mb-2"></i>
                                            <div class="h4 mb-1">{{ number_format($region->pollingStations->avg('number_of_voters'), 0) }}</div>
                                            <div class="text-body-secondary small">Среднее на участок</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Таблица участков --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-0 p-4">
                                    <h3 class="h5 mb-0">
                                        <i class="fa-solid fa-list text-danger me-2"></i>
                                        Список участков для голосования
                                    </h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <th class="px-4 py-3">ID</th>
                                                    <th class="py-3">Номер участка</th>
                                                    <th class="py-3">Количество избирателей</th>
                                                    <th class="py-3 text-end pe-4">Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($region->pollingStations as $station)
                                                    <tr>
                                                        <td class="px-4 py-3">
                                                            <span class="badge text-bg-secondary">{{ $station->id }}</span>
                                                        </td>
                                                        <td class="py-3">
                                                            <strong>{{ $station->stage_number }}</strong>
                                                        </td>
                                                        <td class="py-3">
                                                            <i class="fa-solid fa-users text-danger me-2"></i>
                                                            {{ number_format($station->number_of_voters) }}
                                                        </td>
                                                        <td class="py-3 text-end pe-4">
                                                            <a href="{{ route('pollingStation.show', $station->id) }}"
                                                               class="btn btn-sm btn-outline-danger">
                                                                <i class="fa-solid fa-eye me-1"></i> Подробнее
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @else
                {{-- Ошибка: регион не найден --}}
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="mb-4">
                                    <i class="fa-solid fa-triangle-exclamation text-danger fs-1"></i>
                                </div>
                                <h1 class="h3 mb-3">Регион не найден</h1>
                                <p class="text-body-secondary mb-4">
                                    К сожалению, регион с указанным ID не существует в нашей базе данных
                                </p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('region.index') }}" class="btn btn-danger">
                                        <i class="fa-solid fa-arrow-left me-2"></i> К списку регионов
                                    </a>
                                    <a href="{{ route('navigation') }}" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-compass me-2"></i> К навигации
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

