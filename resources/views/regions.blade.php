@extends('layout')

@section('title', 'Регионы')

@section('content')
    <section class="bg-body min-vh-100">
        <div class="container py-5 py-lg-6">

            {{-- Заголовок --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Главная</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('navigation') }}" class="text-decoration-none">Навигация</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Регионы</li>
                                </ol>
                            </nav>
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fa-solid fa-map-location-dot text-danger me-2"></i>
                                Регионы
                            </h1>
                            <p class="text-body-secondary mb-0">
                                География наших успешных операций по всему миру
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('navigation') }}" class="btn btn-outline-danger">
                                <i class="fa-solid fa-arrow-left me-2"></i> Назад
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Список регионов --}}
            @if($regions->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <i class="fa-solid fa-map-location-dot text-body-tertiary fs-1 mb-3"></i>
                                <h3 class="h5 mb-2">Регионы не найдены</h3>
                                <p class="text-body-secondary mb-0">
                                    В данный момент список регионов пуст
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach($regions as $region)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-lift">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                                            <i class="fa-solid fa-map-pin text-danger fs-4"></i>
                                        </div>
                                        <span class="badge text-bg-secondary">ID: {{ $region->id }}</span>
                                    </div>
                                    <h3 class="h5 mb-3">{{ $region->name }}</h3>
                                    <p class="text-body-secondary small mb-3">
                                        Регион проведения избирательных операций
                                    </p>
                                    <a href="{{ route('region.show', $region->id) }}" class="btn btn-danger w-100">
                                        <i class="fa-solid fa-eye me-2"></i> Смотреть участки
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Статистика --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 bg-danger bg-opacity-10">
                            <div class="card-body p-4 text-center">
                                <h4 class="h5 mb-2">
                                    <i class="fa-solid fa-chart-simple text-danger me-2"></i>
                                    Статистика
                                </h4>
                                <p class="text-body-secondary mb-0">
                                    Всего регионов: <strong class="text-danger">{{ $regions->count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

