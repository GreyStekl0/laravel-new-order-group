@if ($msg = session('success'))
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index:1100">
        <div class="toast align-items-center text-bg-success border-0" data-bs-delay="4000" data-auto-show="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ $msg }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif
