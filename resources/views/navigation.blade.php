@extends('layout')

@section('title', 'Навигация')

@section('content')
    <section class="bg-body min-vh-100 d-flex align-items-center">
        <div class="container py-5 py-lg-6">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9">

                    {{-- Заголовок --}}
                    <div class="text-center mb-5">
                        <span class="badge text-bg-danger mb-3 rounded-pill px-3 py-2">
                            <i class="fa-solid fa-compass me-2"></i>
                            Навигация по системе
                        </span>
                        <h1 class="display-5 fw-bold mb-3">
                            Изучите наши <span class="text-danger">работы</span>
                        </h1>
                        <p class="lead text-body-secondary mb-0">
                            Выберите раздел для просмотра примеров наших успешных кампаний
                        </p>
                    </div>

                    {{-- Сетка с карточками навигации --}}
                    <div class="row g-4">

                        {{-- Регионы --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                            <i class="fa-solid fa-map-location-dot text-danger fs-3"></i>
                                        </div>
                                        <h3 class="h4 mb-0">Регионы</h3>
                                    </div>
                                    <p class="text-body-secondary mb-4">
                                        Просмотрите список регионов, в которых мы проводили свои операции.
                                        От небольших городов до целых стран - мы работаем везде.
                                    </p>
                                    <a href="{{ route('region.index') }}" class="btn btn-danger w-100">
                                        <i class="fa-solid fa-arrow-right me-2"></i> Перейти к регионам
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Участки для голосования --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                            <i class="fa-solid fa-location-dot text-danger fs-3"></i>
                                        </div>
                                        <h3 class="h4 mb-0">Участки для голосования</h3>
                                    </div>
                                    <p class="text-body-secondary mb-4">
                                        Изучите данные об избирательных участках, где мы гарантировали
                                        нужный результат с математической точностью.
                                    </p>
                                    <a href="{{ route('pollingStation.index') }}" class="btn btn-danger w-100">
                                        <i class="fa-solid fa-arrow-right me-2"></i> Перейти к участкам
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Кандидаты (скоро) --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm bg-body-tertiary">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                                            <i class="fa-solid fa-people-group text-secondary fs-3"></i>
                                        </div>
                                        <div>
                                            <h3 class="h4 mb-0">Кандидаты</h3>
                                            <span class="badge text-bg-secondary small">Скоро</span>
                                        </div>
                                    </div>
                                    <p class="text-body-secondary mb-4">
                                        Познакомьтесь с кандидатами, которых мы привели к власти.
                                        От местных чиновников до президентов.
                                    </p>
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fa-solid fa-lock me-2"></i> В разработке
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Итоги по участкам (скоро) --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm bg-body-tertiary">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                                            <i class="fa-solid fa-square-poll-vertical text-secondary fs-3"></i>
                                        </div>
                                        <div>
                                            <h3 class="h4 mb-0">Итоги по участкам</h3>
                                            <span class="badge text-bg-secondary small">Скоро</span>
                                        </div>
                                    </div>
                                    <p class="text-body-secondary mb-4">
                                        Детальная статистика по каждому участку. Посмотрите, как мы
                                        обеспечиваем нужные цифры без лишних подозрений.
                                    </p>
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fa-solid fa-lock me-2"></i> В разработке
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Дополнительные действия --}}
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-danger border-2">
                                <div class="card-body p-4 text-center">
                                    <div
                                        class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                                        <div class="text-start">
                                            <h4 class="h5 mb-1">
                                                <i class="fa-solid fa-house text-danger me-2"></i>
                                                Хотите вернуться на главную, {{ auth()->user()->name }}?
                                            </h4>
                                            <p class="text-body-secondary small mb-0">
                                                Узнайте больше о Laravel New Order Group
                                            </p>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="/" class="btn btn-outline-danger">
                                                <i class="fa-solid fa-arrow-left me-2"></i> На главную
                                            </a>
                                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Выйти
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

