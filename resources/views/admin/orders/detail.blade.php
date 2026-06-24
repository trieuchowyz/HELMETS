@extends('admin.layouts.app')
@section('title', 'Chi tiết Đơn hàng #ORD-' . $order->id)

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white fw-bold">Thông tin Khách hàng</div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                <p><strong>Địa chỉ giao:</strong> {{ $order->shipping_address }}</p>
                <p><strong>Thanh toán:</strong> {{ $order->payment_method }}</p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">Cập nhật trạng thái</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <select name="status" class="form-select mb-3">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao hàng</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã giao xong</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sync-alt"></i> Cập nhật</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">Chi tiết sản phẩm</div>
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center">Đơn giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end pe-4">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->details as $detail)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $detail->product->img ?? '' }}" width="50" class="rounded me-3">
                                    <span class="fw-bold">{{ $detail->product->name ?? 'Sản phẩm đã bị xóa' }}</span>
                                </div>
                            </td>
                            <td class="text-center">{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-end fw-bold text-danger pe-4">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light fw-bold fs-5">
                        <tr>
                            <td colspan="3" class="text-end">Tổng cộng:</td>
                            <td class="text-end text-danger pe-4">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection