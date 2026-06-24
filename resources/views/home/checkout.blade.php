@extends('layouts.main')

@section('noidungwebsite')
    @include('partials.singlepageheader', ['title' => 'Thanh toán'])

    <div class="container-fluid py-5">
        <div class="container py-5">
            <form action="{{ route('cart.processCheckout') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-lg-7">
                        <h4 class="mb-4 border-bottom pb-2">Thông tin giao hàng</h4>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Địa chỉ nhận hàng (Bắt buộc) <span class="text-danger">*</span></label>
                                <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Ghi rõ số nhà, tên đường, phường/xã, quận/huyện..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phương thức thanh toán</label>
                                <select name="payment_method" class="form-select">
                                    <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                                    <option value="BANK_TRANSFER">Chuyển khoản ngân hàng</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0 text-white">Tóm tắt đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                @foreach($carts as $item)
                                    <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                        <span>{{ $item->product->name ?? 'Linh kiện' }} <b>x{{ $item->quantity }}</b></span>
                                        <span class="fw-bold">{{ number_format($item->total, 0, ',', '.') }}đ</span>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between mt-4">
                                    <h5 class="mb-0">Tổng cộng</h5>
                                    <h5 class="text-danger mb-0">{{ number_format($total, 0, ',', '.') }}đ</h5>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 p-3">
                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold">ĐẶT HÀNG NGAY</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection