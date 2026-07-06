@extends('admin.layout.app')

@section('content')
<div class="admin-shell">
  <div class="admin-main">
    <main class="dashboard-content">
      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading">
          <a href="{{ route('admin.quanly-donhang') }}" class="btn btn-sm btn-outline-secondary mb-3">
              <i class="bi bi-arrow-left"></i> Quay lại danh sách
          </a>
          <h1 class="h3 mb-1">Chi tiết Đơn hàng: #HMD-{{ $order->id }}</h1>
          <p class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif

        <div class="row g-4 mt-2">
            <div class="col-xl-4">
                
                <div class="panel p-4 mb-4 border-top border-4 border-primary shadow-sm">
                    <h5 class="mb-3"><i class="bi bi-truck me-2"></i>Tiến trình giao hàng</h5>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao hàng</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>

                <div class="panel p-4 shadow-sm">
                    <h5 class="mb-4 border-bottom pb-2"><i class="bi bi-person-lines-fill me-2"></i>Thông tin nhận hàng</h5>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Khách hàng</small>
                        <span class="fw-semibold">{{ $order->customer_name ?? ($order->user->name ?? 'Khách vãng lai') }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Số điện thoại</small>
                        <span class="fw-semibold">{{ $order->customer_phone ?? ($order->user->phone ?? 'Chưa cập nhật') }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Địa chỉ giao hàng</small>
                        <span class="fw-semibold">{{ $order->shipping_address }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Phương thức thanh toán</small>
                        @if($order->payment_method == 'COD')
                            <span class="badge text-bg-secondary">Thanh toán khi nhận hàng (COD)</span>
                        @else
                            <span class="badge text-bg-info">Chuyển khoản ({{ $order->payment_method }})</span>
                        @endif
                    </div>

                    @if($order->note)
                    <div class="mb-3 p-3 bg-light rounded text-danger">
                        <small class="text-muted d-block mb-1">Ghi chú của khách:</small>
                        <em>"{{ $order->note }}"</em>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-8">
                <div class="panel h-100 shadow-sm">
                    <div class="panel-header border-bottom p-3">
                        <h2 class="h5 mb-0"><i class="bi bi-box-seam me-2"></i>Sản phẩm đã đặt</h2>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->details as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $item->product && $item->product->img ? asset($item->product->img) : asset('admin_assets/images/no-image.jpg') }}" alt="" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <p class="fw-semibold mb-0">{{ $item->product->name ?? 'Sản phẩm không tồn tại' }}</p>
                                                <small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                    <td class="text-center fw-bold">x{{ $item->quantity }}</td>
                                    <td class="text-end fw-semibold text-danger">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Phí giao hàng:</td>
                                    <td class="text-end fw-semibold">{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                                    <td class="text-end fw-bold fs-5 text-danger">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </main>
  </div>
</div>
@endsection