@extends('layout')

@section('title', 'Добро пожаловать')

@section('content')
    <section class="bg-body min-vh-100 d-flex align-items-center">
        <div class="container py-5 py-lg-6">
            <div class="row justify-content-between align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge text-bg-danger mb-3 rounded-pill px-3 py-2">
                        <i class="fa-solid fa-user-secret me-2"></i>
                        Laravel New Order Group
                    </span>

                    <h1 class="display-4 fw-bold lh-1 mb-3">
                        Когда штурм <span class="text-danger">запрещён</span>, остаётся демократия
                    </h1>

                    <p class="lead text-body-secondary mb-4">
                        В золотые времена города брались силой, страхом и обманом. Власть доставалась самым достойным,
                        могущественным и великим. Теперь же всё стало по другому. Теперь людям нужна "демократия", нужны
                        "выборы", "представительство разных идей и кандидатов". Как же быть злодею в таких условиях?
                    </p>

                    <hr class="border-danger border-3 opacity-100 my-4">

                    <h2 class="h4 fw-bold mb-3">Laravel New Order Group - ваше спасение от демократии</h2>
                    <p class="mb-3 text-body-secondary">
                        Laravel New Order Group - это бизнес-решение для тех, кто хочет сохранить власть и влияние
                        в условиях наступившей демократии. Вам больше не придётся самостоятельно заниматься изучением
                        особенностей избирательного процесса в желаемом городе, регионе или целой стране, искать
                        подкупных избирателей, проводить вбросы бюллетеней и заниматься другими утомительными делами.
                    </p>
                    <p class="mb-3 text-body-secondary">
                        Laravel New Order Group осознаёт все сложности и риски, связанные с современными выборами, и
                        предлагает комплексный подход к их решению. Мы делаем капитал, выигрывая выборы для самых
                        честных
                        и достойных кандидатов, при этом оставаясь незамеченными для окружающих.
                    </p>
                    <p class="mb-0 text-body-secondary">
                        Laravel New Order Group осознаёт, что, возможно, не каждый ещё слышал о наших работах, поэтому
                        заходя и авторизовавшись на сайте, вы можете посмотреть на примеры выигранных нами выборов, это
                        лишь малая часть из всех наших работ, но даже этого маленького количества будет достаточно,
                        чтобы вы могли посмотреть то, каким кандидатам мы можем получить власть.
                    </p>
                </div>

                <div class="col-lg-5">
                    <div class="card bg-body-tertiary border-0 shadow-lg">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <i class="fa-solid fa-skull text-danger fs-3 me-3"></i>
                                <h3 class="h5 mb-0">Что вы увидите внутри</h3>
                            </div>

                            <ul class="list-unstyled m-0">
                                <li class="mb-3 d-flex">
                                    <i class="fa-solid fa-map-location-dot text-danger me-3 mt-1"></i>
                                    <div>
                                        <strong>Список регионов</strong>
                                        <div class="text-body-secondary small">
                                            Мы работаем в любом месте этого или любого другого измерения.
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex">
                                    <i class="fa-solid fa-location-dot text-danger me-3 mt-1"></i>
                                    <div>
                                        <strong>Список участков для голосования</strong>
                                        <div class="text-body-secondary small">
                                            Мы способны влиять не только на итоговые выборы,
                                            но и на каждый участок по отдельности.
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex">
                                    <i class="fa-solid fa-people-group text-danger me-3 mt-1"></i>
                                    <div>
                                        <strong>Список кандидатов</strong>
                                        <div class="text-body-secondary small">
                                            Мы готовы не только привести к власти вас или вашего кандидата, но и
                                            предоставить своего, абсолютно верного и покорного каждому вашему слову
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <i class="fa-solid fa-square-poll-vertical text-danger me-3 mt-1"></i>
                                    <div>
                                        <strong>Итоги по участкам</strong>
                                        <div class="text-body-secondary small">
                                            Вы можете посмотреть каких кандидатов мы обыгрывали и не вызывали
                                            подозрений.
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            @guest
                                <div class="mt-4">
                                    <a href="{{ route('login') }}" class="btn btn-danger btn-lg w-100">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> Войти в аккаунт
                                    </a>
                                </div>
                            @endguest

                            @auth
                                <div class="mt-4">
                                    <a href="{{ route('regions.index') }}" class="btn btn-outline-danger btn-lg w-100">
                                        <i class="fa-solid fa-forward me-2"></i> Перейти к примерам работы
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

