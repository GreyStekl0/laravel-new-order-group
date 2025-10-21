@extends('layout')

@section('title', $pollingStation ? 'Участок №' . $pollingStation->stage_number : 'Участок не найден')

@section('content')
    <section class="bg-body min-vh-100">
        <div class="container py-5 py-lg-6">

            @if($pollingStation)
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
                                        <li class="breadcrumb-item"><a href="{{ route('pollingStation.index') }}"
                                                                       class="text-decoration-none">Участки</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Участок
                                            №{{ $pollingStation->stage_number }}</li>
                                    </ol>
                                </nav>
                                <h1 class="display-6 fw-bold mb-2">
                                    <i class="fa-solid fa-location-dot text-danger me-2"></i>
                                    Участок №{{ $pollingStation->stage_number }}
                                </h1>
                                <p class="text-body-secondary mb-0">
                                    <i class="fa-solid fa-map-pin text-danger me-2"></i>
                                    {{ $pollingStation->region->name }}
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                @can('manage-polling-stations')
                                    <a href="{{ route('pollingStation.edit', $pollingStation->id) }}"
                                       class="btn btn-danger">
                                        <i class="fa-solid fa-pen me-2"></i> Редактировать
                                    </a>
                                @endcan
                                <a href="{{ route('pollingStation.index') }}" class="btn btn-outline-danger">
                                    <i class="fa-solid fa-arrow-left me-2"></i> К списку
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Информация об участке --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 bg-danger bg-opacity-10">
                            <div class="card-body p-4">
                                <div class="row text-center">
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-hashtag text-danger fs-3 mb-2"></i>
                                        <div class="h4 mb-1">{{ $pollingStation->id }}</div>
                                        <div class="text-body-secondary small">ID участка</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-users text-danger fs-3 mb-2"></i>
                                        <div
                                            class="h4 mb-1">{{ number_format($pollingStation->number_of_voters) }}</div>
                                        <div class="text-body-secondary small">Зарегистрировано избирателей</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-check-to-slot text-danger fs-3 mb-2"></i>
                                        <div class="h4 mb-1">{{ number_format($total) }}</div>
                                        <div class="text-body-secondary small">Проголосовало</div>
                                    </div>
                                    <div class="col-md-3 col-6 py-3 py-md-0">
                                        <i class="fa-solid fa-percent text-danger fs-3 mb-2"></i>
                                        <div class="h4 mb-1">
                                            {{ $pollingStation->number_of_voters > 0 ? number_format(($total / $pollingStation->number_of_voters) * 100, 2) : 0 }}
                                            %
                                        </div>
                                        <div class="text-body-secondary small">Явка</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Результаты голосования по кандидатам --}}
                @if($pollingStation->candidates->isEmpty())
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-5 text-center">
                                    <i class="fa-solid fa-people-group text-body-tertiary fs-1 mb-3"></i>
                                    <h3 class="h5 mb-2">Результаты не подведены</h3>
                                    <p class="text-body-secondary mb-0">
                                        На участке №{{ $pollingStation->stage_number }} пока нет результатов голосования
                                    </p>
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
                                        <i class="fa-solid fa-chart-column text-danger me-2"></i>
                                        Результаты голосования по кандидатам
                                    </h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="border-bottom">
                                            <tr>
                                                <th class="px-4 py-3">ID</th>
                                                <th class="py-3">Кандидат</th>
                                                <th class="py-3">Количество голосов</th>
                                                <th class="py-3 text-end pe-4">Процент</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pollingStation->candidates as $candidate)
                                                <tr>
                                                    <td class="px-4 py-3">
                                                        <span
                                                            class="badge text-bg-secondary">{{ $candidate->id }}</span>
                                                    </td>
                                                    <td class="py-3">
                                                        <i class="fa-solid fa-user text-danger me-2"></i>
                                                        <strong>{{ $candidate->name }}</strong>
                                                    </td>
                                                    <td class="py-3">
                                                        <i class="fa-solid fa-check-to-slot text-danger me-2"></i>
                                                        {{ number_format($candidate->pivot->number_of_voters) }}
                                                    </td>
                                                    <td class="py-3 text-end pe-4">
                                                        @php
                                                            $percentage = $total > 0 ? ($candidate->pivot->number_of_voters / $total) * 100 : 0;
                                                        @endphp
                                                        <span class="badge text-bg-danger fs-6">
                                                                {{ number_format($percentage, 2) }}%
                                                            </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot class="border-top">
                                            <tr class="table-active">
                                                <td colspan="2" class="px-4 py-3"><strong>Итого:</strong></td>
                                                <td class="py-3">
                                                    <strong>
                                                        <i class="fa-solid fa-check-to-slot text-danger me-2"></i>
                                                        {{ number_format($total) }} голосов
                                                    </strong>
                                                </td>
                                                <td class="py-3 text-end pe-4">
                                                    <span class="badge text-bg-success fs-6">100%</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Визуализация результатов --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h4 class="h6 mb-3">
                                        <i class="fa-solid fa-chart-pie text-danger me-2"></i>
                                        Визуальное представление
                                    </h4>
                                    @foreach($pollingStation->candidates as $candidate)
                                        @php
                                            $percentage = $total > 0 ? ($candidate->pivot->number_of_voters / $total) * 100 : 0;
                                        @endphp
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="small">{{ $candidate->name }}</span>
                                                <span class="small text-body-secondary">{{ number_format($percentage, 2) }}%</span>
                                            </div>
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-danger"
                                                     role="progressbar"
                                                     style="width: {{ $percentage }}%;"
                                                     aria-valuenow="{{ $percentage }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    {{ number_format($candidate->pivot->number_of_voters) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @else
                {{-- Ошибка: участок не найден --}}
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="mb-4">
                                    <i class="fa-solid fa-triangle-exclamation text-danger fs-1"></i>
                                </div>
                                <h1 class="h3 mb-3">Участок не найден</h1>
                                <p class="text-body-secondary mb-4">
                                    К сожалению, участок для голосования с указанным ID не существует в нашей базе
                                    данных
                                </p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('pollingStation.index') }}" class="btn btn-danger">
                                        <i class="fa-solid fa-arrow-left me-2"></i> К списку участков
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

