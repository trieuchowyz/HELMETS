@extends('admin.layout.app')

@section('content')

        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-bag-check" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Kinh doanh</p>
                <h1 class="h3 mb-1">Quản lý Đơn hàng</h1>
                <p class="text-muted mb-0">Theo dõi, duyệt và quản lý tiến trình giao hàng.</p>
              </div>
            </div>
          </div>

          <section class="panel">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Danh sách đơn hàng</span></h2>
                <p class="text-muted mb-0">Cập nhật trạng thái mới nhất của khách hàng.</p>
              </div>
              <input class="form-control form-control-sm table-search" type="search" placeholder="Tìm mã đơn..." data-table-search="ordersTable" aria-label="Search orders">
            </div>
            
            <div class="table-responsive">
              <table class="table align-middle mb-0" id="ordersTable" data-searchable-table>
                
                <thead>
                  <tr>
                    <th>Mã Đơn</th>
                    <th>Khách Hàng</th>
                    <th>Trạng Thái</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Đặt</th>
                    <th class="text-end">Hành Động</th>
                  </tr>
                </thead>
                
                <tbody>
                  @foreach($orders as $order)
                  <tr>
                    <td class="fw-semibold">#HMD-{{ $order->id }}</td>
                    <td>
                      <div class="fw-semibold">{{ $order->customer_name ?? ($order->user->name ?? 'Khách vãng lai') }}</div>
                      <small class="text-muted">{{ $order->customer_phone ?? ($order->user->phone ?? 'Chưa có SĐT') }}</small>
                    </td>
                    <td>
                        @if($order->status == 'completed')
                            <span class="badge text-bg-success">Hoàn thành</span>
                        @elseif($order->status == 'shipped')
                            <span class="badge text-bg-primary">Đang giao</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge text-bg-danger">Đã hủy</span>
                        @else
                            <span class="badge text-bg-warning">Chờ xử lý</span>
                        @endif
                    </td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-light btn-sm">Xem chi tiết</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </section>

        </div>


@endsection
