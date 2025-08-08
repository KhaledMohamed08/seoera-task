@if (session('success') || session('fail'))
    @php
        $type = session('success') ? 'success' : 'danger';
        $message = session('success') ?? session('fail');
        $icon = $type === 'success' ? 'bi-check-circle' : 'bi-exclamation-octagon';
    @endphp

    <div class="alert alert-{{ $type }} alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi {{ $icon }} me-2 fs-5"></i>
        <div>{{ $message }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif