@extends('admin.layouts.app')
@section('title', 'Quản lý Đơn hàng')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Danh sách đơn đặt hàng</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold">#ORD-{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                            @elseif($order->status == 'processing')
                                <span class="badge bg-info text-dark">Đang chuẩn bị hàng</span>
                            @elseif($order->status == 'shipped')
                                <span class="badge bg-primary">Đang giao hàng</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Đã giao xong</span>
                            @else
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white pt-3">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection