@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between" aria-label="Пагинация">
        {{-- Мобильная версия --}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-body-secondary">
                            <i class="fa-solid fa-chevron-left"></i> Назад
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link border-0 bg-danger text-white" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="fa-solid fa-chevron-left"></i> Назад
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link border-0 bg-danger text-white" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            Вперёд <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-body-secondary">
                            Вперёд <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Десктопная версия --}}
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div class="d-flex align-items-center gap-3">
                <p class="small text-body-secondary mb-0">
                    <i class="fa-solid fa-list text-danger me-2"></i>
                    Показано с <span class="fw-semibold text-danger">{{ $paginator->firstItem() }}</span>
                    по <span class="fw-semibold text-danger">{{ $paginator->lastItem() }}</span>
                    из <span class="fw-semibold text-danger">{{ $paginator->total() }}</span>
                    {{ trans_choice('записей|запись|записи', $paginator->total()) }}
                </p>

                {{-- Выбор количества элементов --}}
                <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2">
                    @foreach(request()->except('perpage', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label for="perpage" class="small text-body-secondary text-nowrap mb-0">
                        <i class="fa-solid fa-sliders text-danger me-1"></i>
                        На странице:
                    </label>
                    <select name="perpage"
                            id="perpage"
                            class="form-select form-select-sm border-danger text-danger bg-danger bg-opacity-10"
                            style="width: auto; min-width: 70px;"
                            onchange="this.form.submit()">
                        <option value="5" @if($paginator->perPage() == 5) selected @endif>5</option>
                        <option value="10" @if($paginator->perPage() == 10) selected @endif>10</option>
                        <option value="15" @if($paginator->perPage() == 15) selected @endif>15</option>
                        <option value="20" @if($paginator->perPage() == 20) selected @endif>20</option>
                        <option value="25" @if($paginator->perPage() == 25) selected @endif>25</option>
                        <option value="50" @if($paginator->perPage() == 50) selected @endif>50</option>
                    </select>
                </form>
            </div>

            <div>
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="Предыдущая">
                            <span class="page-link border-0 bg-body-secondary" aria-hidden="true">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0 bg-danger text-white" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Предыдущая">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link border-0 bg-body-secondary">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link border-0 bg-danger text-white">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link border-0 text-danger bg-danger bg-opacity-10" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link border-0 bg-danger text-white" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Следующая">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Следующая">
                            <span class="page-link border-0 bg-body-secondary" aria-hidden="true">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
