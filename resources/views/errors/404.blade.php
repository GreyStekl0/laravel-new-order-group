@extends('layout')

@section('title', '404 - Страница не найдена')

@section('content')
    <section class="bg-body min-vh-100 d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">

                            {{-- Иконка ошибки --}}
                            <div class="mb-4">
                                <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex p-4 mb-3">
                                    <i class="fa-solid fa-magnifying-glass text-danger" style="font-size: 4rem;"></i>
                                </div>
                            </div>

                            {{-- Код ошибки --}}
                            <div class="mb-3">
                                <span class="badge text-bg-danger fs-5 px-4 py-2">
                                    Ошибка 404
                                </span>
                            </div>

                            {{-- Заголовок --}}
                            <h1 class="display-6 fw-bold mb-3">
                                Страница не найдена
                            </h1>

                            {{-- Сообщение об ошибке --}}
                            <p class="lead text-body-secondary mb-4">
                                К сожалению, запрашиваемая вами страница не существует или была перемещена
                            </p>

                            {{-- Дополнительная информация --}}
                            <div class="alert alert-warning d-flex align-items-start text-start mb-4" role="alert">
                                <i class="fa-solid fa-circle-exclamation me-3 mt-1"></i>
                                <div>
                                    <strong>Что могло произойти:</strong>
                                    <ul class="mb-0 mt-2 ps-3">
                                        <li>Страница была удалена или перемещена</li>
                                        <li>В адресе страницы допущена ошибка</li>
                                        <li>Ссылка, по которой вы перешли, устарела</li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Кнопки действий --}}
                            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                <a href="{{ url()->previous(url('/')) }}" class="btn btn-danger btn-lg">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Вернуться назад
                                </a>
                                <a href="/" class="btn btn-outline-danger btn-lg">
                                    <i class="fa-solid fa-house me-2"></i> На главную
                                </a>
                                @auth
                                    <a href="{{ route('navigation') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fa-solid fa-compass me-2"></i> К навигации
                                    </a>
                                @endauth
                            </div>

                        </div>
                    </div>

                    {{-- Популярные разделы --}}
                    @auth
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body p-4">
                                <h4 class="h6 mb-3">
                                    <i class="fa-solid fa-star text-danger me-2"></i>
                                    Возможно, вы искали:
                                </h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('region.index') }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-map-location-dot me-1"></i> Регионы
                                    </a>
                                    <a href="{{ route('pollingStation.index') }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-location-dot me-1"></i> Участки для голосования
                                    </a>
                                    <a href="{{ route('navigation') }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-compass me-1"></i> Навигация
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endauth

                    {{-- Юмористическая подпись --}}
                    <div class="text-center mt-4">
                        <p class="text-body-secondary small mb-0">
                            <i class="fa-solid fa-ghost me-2"></i>
                            Эта страница исчезла так же бесследно, как и голоса оппозиции
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

