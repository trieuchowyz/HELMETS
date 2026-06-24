@extends('layouts.main')

@section('noidungwebsite')

    @include('partials.singlepageheader', ['title' => $product->name])

    <div class="container-fluid shop py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">

                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded bg-light d-flex justify-content-center align-items-center p-3 h-100">
                                <a href="#">
                                    <img src="{{ asset($product->img) }}" class="img-fluid rounded w-100" style="object-fit: contain; max-height: 400px;" alt="{{ $product->name }}">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-3 text-dark">{{ $product->name }}</h3>
                            <p class="mb-3 text-muted">Danh mục: <span class="text-primary fw-bold">{{ $product->menu->name ?? 'Chưa cập nhật' }}</span></p>

                            <h4 class="fw-bold mb-3 text-danger fs-2">{{ number_format($product->price, 0, ',', '.') }}đ</h4>

                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <span class="ms-2 text-muted">(Đánh giá tốt)</span>
                            </div>

                            @if($product->color)
                                <p class="mb-3">Màu sắc: <strong>{{ $product->color }}</strong></p>
                            @endif

                            <p class="mb-4">{{ $product->detail }}</p>

                            <div class="input-group quantity mb-4" style="width: 140px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="qty-detail" class="form-control form-control-sm text-center border-0 bg-white" value="1" readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#" data-id="{{ $product->id }}" class="btn btn-add-detail btn-primary rounded-pill px-5 py-3 fw-bold text-uppercase shadow-sm">
                                <i class="fa fa-cart-plus me-2"></i> Mua Ngay
                            </a>
                        </div>

                        <div class="col-lg-12 mt-5">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0 fw-bold text-primary fs-5" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Mô tả chi tiết sản phẩm</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5 border p-4 rounded bg-light">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p class="mb-0" style="line-height: 1.8;">{{ $product->detail ?? 'Sản phẩm đang được cập nhật thông tin chi tiết.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="mb-4 border p-4 rounded bg-white shadow-sm">
                                <h5 class="fw-bold border-bottom pb-3 mb-4">Danh mục nón</h5>
                                <ul class="list-unstyled fruite-categorie">
                                    @if(isset($menus))
                                        @foreach($menus as $menu)
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name mb-3 pb-2 border-bottom">
                                                    <a href="{{ url($menu->slug == '/' ? '/' : $menu->slug) }}" class="text-dark hover-primary text-decoration-none"><i class="fas fa-chevron-right me-2 text-primary small"></i>{{ $menu->name }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Nút tăng giảm số lượng
            $('.btn-plus').click(function() {
                let input = $('#qty-detail');
                input.val(parseInt(input.val()) + 1);
            });
            $('.btn-minus').click(function() {
                let input = $('#qty-detail');
                if(parseInt(input.val()) > 1) {
                    input.val(parseInt(input.val()) - 1);
                }
            });

            // Xử lý nút Thêm vào giỏ
            $('.btn-add-detail').click(function(e) {
                e.preventDefault();
                let pid = $(this).data('id');
                let q = $('#qty-detail').val(); 

                $.ajax({
                    url: '/addproduct/' + pid + '/' + q,
                    type: 'GET',
                    success: function(response) {
                        alert(response.message); 
                    },
                    error: function(xhr) {
                        if(xhr.status === 401) {
                            alert("Bạn cần đăng nhập để thêm vào giỏ hàng!");
                            window.location.href = '/login'; 
                        } else {
                            alert("Có lỗi xảy ra, vui lòng thử lại.");
                        }
                    }
                });
            });
        });
    </script>
@endsection