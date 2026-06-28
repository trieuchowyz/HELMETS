@extends('layouts.main')

@section('noidungwebsite')
    @include('partials.singlepageheader', ['title' => 'Giỏ hàng của bạn'])

    <div class="container-fluid py-5">
        <div class="container py-5">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng cộng</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $i)
                            <tr class="cart-row" data-id="{{ $i->id }}">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($i->product->img) }}" class="img-fluid me-5 rounded"
                                            style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $i->product->name }}">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4 fw-bold">{{ $i->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ number_format($i->price, 0, ',', '.') }}đ</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border custom-btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 qty-input"
                                            data-id="{{ $i->id }}" value="{{ $i->quantity }}" readonly>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border custom-btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 item-total text-danger fw-bold" id="item-total-{{ $i->id }}">
                                        {{ number_format($i->total, 0, ',', '.') }}đ
                                    </p>
                                </td>
                                <td>
                                    <button type="button" data-id="{{ $i->id }}" class="btn btn-md rounded-circle bg-light border mt-4 btndel" title="Xóa sản phẩm">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-3 py-3 mb-4" placeholder="Nhập mã giảm giá">
                <button class="btn btn-primary rounded-pill px-4 py-3" type="button">Áp dụng</button>
            </div>
            
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded p-4">
                        <h1 class="display-6 mb-4">Tổng <span class="fw-normal">Giỏ Hàng</span></h1>
                        <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                            <h5 class="mb-0 me-4">Tạm tính:</h5>
                            <p class="mb-0 fw-bold" id="cart-subtotal">{{ number_format($total, 0, ',', '.') }}đ</p>
                        </div>
                        <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                            <h5 class="mb-0 me-4">Phí vận chuyển:</h5>
                            <div class="">
                                <p class="mb-0">Cố định: 75.000đ</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 ps-4 me-4">Thành tiền</h5>
                            <p class="mb-0 pe-4 text-danger fw-bold fs-5" id="cart-total">{{ number_format($total + 75000, 0, ',', '.') }}đ</p>
                        </div>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary rounded-pill px-4 py-3 text-uppercase w-100 fw-bold">Tiến hành đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Đã fix định dạng JS để nối thêm chữ "đ" giống y hệt lúc blade render
            function formatCurrency(amount) {
                return amount.toLocaleString('vi-VN') + 'đ';
            }

            function updateCartItem(id, quantity) {
                $.ajax({
                    url: '{{ route("cart.updateajax") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#item-total-' + id).text(formatCurrency(response.item_total));
                            $('#cart-subtotal').text(formatCurrency(response.cart_total));
                            $('#cart-total').text(formatCurrency(response.cart_total + 75000));
                        }
                    }
                });
            }

            $('.custom-btn-plus').off('click').on('click', function(e) {
                e.preventDefault();
                let input = $(this).closest('.quantity').find('.qty-input');
                let id = input.data('id');
                let newVal = parseInt(input.val()) + 1;
                input.val(newVal);
                updateCartItem(id, newVal);
            });

            $('.custom-btn-minus').off('click').on('click', function(e) {
                e.preventDefault();
                let input = $(this).closest('.quantity').find('.qty-input');
                let id = input.data('id');
                let newVal = parseInt(input.val()) - 1;
                if (newVal > 0) {
                    input.val(newVal);
                    updateCartItem(id, newVal);
                } else {
                    input.val(1);
                }
            });

            $('.btndel').off('click').on('click', function(e) {
                e.preventDefault();
                let btn = $(this);
                let id = btn.data('id');
                let row = btn.closest('.cart-row');

                if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?")) {
                    $.ajax({
                        url: '/delete-cart/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if(res.deleted) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                $('#cart-subtotal').text(formatCurrency(res.cart_total));
                                $('#cart-total').text(formatCurrency(res.cart_total + 75000));
                                if(res.cart_total == 0) {
                                    setTimeout(() => location.reload(), 500);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection