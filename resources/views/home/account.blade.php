@extends('layouts.main')

@section('noidungwebsite')
    @include('partials.singlepageheader', ['title' => 'Tài khoản của tôi'])

    <div class="container-fluid py-5">
        <div class="container py-5">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-5">
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                            <hr>
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 rounded-pill">Đăng xuất</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <h3 class="mb-4 text-primary border-bottom pb-2">Lịch sử đơn hàng của bạn</h3>
                    
                    @if($orders->count() > 0)
                        <div class="accordion" id="orderAccordion">
                            @foreach($orders as $order)
                                <div class="accordion-item mb-3 border shadow-sm rounded">
                                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}">
                                            Đơn hàng #HMD-{{ $order->id }} &nbsp;|&nbsp; 
                                            Ngày đặt: {{ $order->created_at->format('d/m/Y') }} &nbsp;|&nbsp; 
                                            <span class="text-danger ms-2">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                                            
                                            <span class="ms-auto badge 
                                                {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                                                {{ $order->status == 'shipped' ? 'bg-primary' : '' }}
                                                {{ $order->status == 'completed' ? 'bg-success' : '' }}
                                                {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}
                                            ">
                                                @if($order->status == 'pending') CHỜ XỬ LÝ
                                                @elseif($order->status == 'shipped') ĐANG GIAO
                                                @elseif($order->status == 'completed') HOÀN THÀNH
                                                @elseif($order->status == 'cancelled') ĐÃ HỦY
                                                @endif
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Giao đến:</strong> {{ $order->shipping_address }}</p>
                                            <p><strong>Thanh toán:</strong> {{ $order->payment_method == 'COD' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' }}</p>
                                            
                                            @if($order->status == 'pending')
                                                <div class="mb-3">
                                                    <form action="{{ route('account.cancelOrder', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle me-1"></i> Hủy đơn hàng này</button>
                                                    </form>
                                                </div>
                                            @endif

                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Đơn giá</th>
                                                        <th>SL</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->details as $item)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ $item->product->img ?? '' }}" width="40" class="me-2 rounded">
                                                                {{ $item->product->name ?? 'SP đã xóa' }}
                                                            </td>
                                                            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td class="text-danger fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 bg-light rounded">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p>Bạn chưa có đơn hàng nào.</p>
                            <a href="{{ url('/') }}" class="btn btn-primary rounded-pill">Tiếp tục mua sắm</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection