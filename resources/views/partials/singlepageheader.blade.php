
<!-- Single Page Header End -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">
        @isset($title)
            {{ $title }}
        @endisset
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">
                @isset($title)
                    {{ $title }}
                @endisset
        </ol>
</div>
