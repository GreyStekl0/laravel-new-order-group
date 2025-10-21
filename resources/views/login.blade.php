@extends('layout')

@section('title', 'Вход')

@section('content')
    <section class="min-vh-100 d-flex align-items-center">
        <div class="container py-5 py-lg-6">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card shadow-sm border-0 mx-auto">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <i class="fa-solid fa-right-to-bracket text-danger fs-3 me-3"></i>
                                <h3 class="h5 mb-0">Войти в аккаунт</h3>
                            </div>

                            {{-- Гость: форма авторизации --}}
                            @guest

                                <form method="POST" action="{{ route('auth') }}" novalidate>
                                    @csrf

                                    {{-- Email --}}
                                    <div class="mb-3 input-group input-group-lg has-validation">
                                      <span class="input-group-text">
                                        <i class="fa-solid fa-at"></i>
                                      </span>
                                        <input
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="username"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="name@example.com"
                                            aria-label="Email">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Пароль --}}
                                    <div class="mb-3 input-group input-group-lg has-validation">
                                      <span class="input-group-text">
                                        <i class="fa-solid fa-key"></i>
                                      </span>
                                        <input
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="••••••••"
                                            aria-label="Пароль">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-danger btn-lg w-100">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> Войти
                                    </button>
                                </form>
                            @endguest

                            {{-- Авторизованный: сообщение + действия --}}
                            @auth
                                <div class="alert alert-success d-flex align-items-center small mb-4" role="alert">
                                    <i class="fa-solid fa-circle-check me-2"></i>
                                    Вы уже вошли как <strong
                                        class="ms-1">{{ user()->name }}</strong>.
                                </div>

                                <a href="{{ route('pollingStation.index') }}" class="btn btn-danger btn-lg w-100 mb-3">
                                    <i class="fa-solid fa-forward me-2"></i> Перейти к разделам
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Выйти
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>

                    {{-- Шуточный дисклеймер под карточкой --}}
                    <p class="text-center text-body-secondary small mt-3 mb-0">
                        Заходя в аккаунт, вы торжественно соглашаетесь передать нам адрес родителей,
                        кличку любимого питомца, девичью фамилию бабушки, название любимого фильма и имя первой любви
                    </p>

                </div>
            </div>
        </div>
    </section>
@endsection
