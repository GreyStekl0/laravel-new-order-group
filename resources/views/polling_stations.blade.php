@extends('layout')

@section('title', 'Участки для голосования')

@section('content')
    <section class="bg-body min-vh-100">
        <div class="container py-5 py-lg-6">

            {{-- Заголовок --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Главная</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('navigation') }}"
                                                                   class="text-decoration-none">Навигация</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Участки для голосования</li>
                                </ol>
                            </nav>
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fa-solid fa-location-dot text-danger me-2"></i>
                                Участки для голосования
                            </h1>
                            <p class="text-body-secondary mb-0">
                                Полный список избирательных участков по всем регионам
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            @can('manage-polling-stations')
                                <a href="{{ route('pollingStation.create') }}" class="btn btn-danger">
                                    <i class="fa-solid fa-plus me-2"></i> Добавить участок
                                </a>
                            @endcan
                            <a href="{{ route('navigation') }}" class="btn btn-outline-danger">
                                <i class="fa-solid fa-arrow-left me-2"></i> Назад
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Статистика --}}
            @if($pollingStations->total() > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 bg-danger bg-opacity-10">
                            <div class="card-body p-4">
                                <div class="row text-center">
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-location-dot text-danger fs-3 mb-2"></i>
                                        <div class="h4 mb-1">{{ $pollingStations->total() }}</div>
                                        <div class="text-body-secondary small">Всего участков</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-users text-danger fs-3 mb-2"></i>
                                        <div
                                            class="h4 mb-1">{{ number_format($pollingStations->sum('number_of_voters')) }}</div>
                                        <div class="text-body-secondary small">Всего избирателей</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-chart-line text-danger fs-3 mb-2"></i>
                                        <div
                                            class="h4 mb-1">{{ number_format($pollingStations->avg('number_of_voters'), 0) }}</div>
                                        <div class="text-body-secondary small">Среднее на участок</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-file-lines text-danger fs-3 mb-2"></i>
                                        <div class="h4 mb-1">{{ $pollingStations->currentPage() }}
                                            / {{ $pollingStations->lastPage() }}</div>
                                        <div class="text-body-secondary small">Страница</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Таблица участков --}}
            @if($pollingStations->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <i class="fa-solid fa-location-dot text-body-tertiary fs-1 mb-3"></i>
                                <h3 class="h5 mb-2">Участки не найдены</h3>
                                <p class="text-body-secondary mb-4">
                                    В данный момент список участков для голосования пуст
                                </p>
                                @can('manage-polling-stations')
                                    <a href="{{ route('pollingStation.create') }}" class="btn btn-danger">
                                        <i class="fa-solid fa-plus me-2"></i> Добавить первый участок
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0 p-4">
                                <h3 class="h5 mb-0">
                                    <i class="fa-solid fa-list text-danger me-2"></i>
                                    Список участков
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="border-bottom">
                                        <tr>
                                            <th class="px-4 py-3">ID</th>
                                            <th class="py-3">Регион</th>
                                            <th class="py-3">Номер участка</th>
                                            <th class="py-3">Избирателей</th>
                                            <th class="py-3 text-end pe-4">Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pollingStations as $station)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <span class="badge text-bg-secondary">{{ $station->id }}</span>
                                                </td>
                                                <td class="py-3">
                                                    <i class="fa-solid fa-map-pin text-danger me-2 d-none d-md-inline d-lg-none"></i>
                                                    <a href="{{ route('region.show', $station->region->id) }}"
                                                       class="text-decoration-none">
                                                        {{ $station->region->name }}
                                                    </a>
                                                </td>
                                                <td class="py-3">
                                                    <strong>{{ $station->stage_number }}</strong>
                                                </td>
                                                <td class="py-3">
                                                    <i class="fa-solid fa-users text-danger me-2"></i>
                                                    {{ number_format($station->number_of_voters) }}
                                                </td>
                                                <td class="py-3 text-end pe-4">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('pollingStation.show', $station->id) }}"
                                                           class="btn btn-sm btn-outline-danger"
                                                           title="Просмотр">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        @can('manage-polling-stations')
                                                            <a href="{{ route('pollingStation.edit', $station->id) }}"
                                                               class="btn btn-sm btn-outline-secondary"
                                                               title="Редактировать">
                                                                <i class="fa-solid fa-pen"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('pollingStation.destroy', $station->id) }}"
                                                                method="POST"
                                                                style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger rounded-0 rounded-end"
                                                                        onclick="return confirm('Вы уверены, что хотите удалить этот участок? Это действие нельзя отменить.')"
                                                                        title="Удалить">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Пагинация --}}
                            @if($pollingStations->hasPages())
                                <div class="card-footer bg-transparent border-0 p-4">
                                    {{ $pollingStations->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
