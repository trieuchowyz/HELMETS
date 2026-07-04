@extends('admin.layout.app')

@section('content')
  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <div class="page-heading">
            <a href="{{ route('admin.customers') }}" class="btn btn-outline-secondary btn-sm mb-3"><i class="bi bi-arrow-left"></i> Quay lại</a>
            <h1 class="h3 mb-1">Chi tiết Khách Hàng</h1>
            <p class="text-muted">Xem thông tin hồ sơ và lịch sử mua hàng trên hệ thống.</p>
          </div>

          <section class="row g-4 mt-2">
            <div class="col-12 col-xl-4">
              <div class="panel h-100 text-center profile-card p-4">
                <div class="profile-hero mt-3">
                  <img class="avatar-img avatar-xl profile-photo mb-3 shadow-sm border" src="{{ $customer->avata ? asset($customer->avata) : asset('admin_assets/images/avatar/default.jpg') }}" alt="" style="width: 120px; height: 120px; object-fit: cover;">
                  <h2 class="h5 mb-1">{{ $customer->name }}</h2>
                  <p class="text-muted mb-3">{{ $customer->email }}</p>
                  
                  @if($customer->status == 1) <span class="badge text-bg-success">Tài khoản Đang hoạt động</span>
                  @else <span class="badge text-bg-danger">Tài khoản Bị khóa</span>
                  @endif
                </div>
                
                <hr class="my-4">
                
                <div class="info-list text-start small">
                  <div class="d-flex justify-content-between border-bottom py-2">
                      <span class="text-muted">Số điện thoại:</span>
                      <strong class="text-dark">{{ $customer->phone ?? 'Chưa cập nhật' }}</strong>
                  </div>
                  <div class="d-flex justify-content-between border-bottom py-2">
                      <span class="text-muted">Địa chỉ:</span>
                      <strong class="text-dark">{{ $customer->address ?? 'Chưa cập nhật' }}</strong>
                  </div>
                  <div class="d-flex justify-content-between border-bottom py-2">
                      <span class="text-muted">Ngày đăng ký:</span>
                      <strong class="text-dark">{{ $customer->created_at->format('d/m/Y H:i') }}</strong>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                      <span class="text-muted">Tổng tiền đã tiêu:</span>
                      <strong class="text-success fs-6">{{ number_format($totalSpent, 0, ',', '.') }} VNĐ</strong>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-12 col-xl-8">
              <div class="panel h-100">
                <div class="panel-header border-bottom p-3">
                    <h2 class="h5 mb-0 section-title"><i class="bi bi-clock-history me-2"></i>Lịch sử mua hàng</h2>
                </div>
                
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="fw-bold">#HMD-{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="fw-semibold text-danger">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                <td>
                                    @if($order->status == 'completed')
                                        <span class="badge text-bg-success">Hoàn thành</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge text-bg-primary">Đang giao</span>
                                    @else
                                        <span class="badge text-bg-warning">Chờ xử lý</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Khách hàng này chưa có đơn hàng nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </section>
          
        </div>
      </main>
    </div>
  </div>
@endsection