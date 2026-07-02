@extends('admin.layout.app')

@section('content')

  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Tổng quan</p>
                <h1 class="h3 mb-1">Bảng điều khiển</h1>
                <p class="text-muted mb-0">Theo dõi hiệu suất, doanh số, người dùng và hỗ trợ từ một không gian làm việc
                  gọn gàng.</p>
              </div>
            </div>
            <div class="heading-actions"><button class="btn btn-outline-secondary btn-sm" type="button"><i
                  class="bi bi-download" aria-hidden="true"></i> Export</button><button class="btn btn-primary btn-sm"
                type="button"><i class="bi bi-file-earmark-plus" aria-hidden="true"></i> Create Report</button></div>
          </div>

          <section class="row g-3 mt-1" aria-label="Dashboard metrics">
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Doanh thu</span>
                  <span class="metric-icon"><i class="bi bi-currency-dollar" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ number_format($totalRevenue, 0, ',', '.') }} đ</div>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Đơn hàng</span>
                  <span class="metric-icon"><i class="bi bi-bag-check" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $totalOrders }}</div>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-warning">
                <div class="metric-top">
                  <span class="metric-label">Khách hàng</span>
                  <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $totalCustomers }}</div>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-danger">
                <div class="metric-top">
                  <span class="metric-label">Sản phẩm</span>
                  <span class="metric-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $totalProducts }}</div>
              </article>
            </div>
          </section>

          <div class="col-12 col-xl-8">
              <div class="panel h-100">
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-bar-chart-line" aria-hidden="true"></i><span>Biểu đồ Doanh thu</span></h2>
                        <p class="text-muted mb-0">Hiển thị doanh thu thực tế 6 tháng gần nhất.</p>
                    </div>
                </div>
                
                <div class="chart-bars" aria-label="Revenue chart">
                    @foreach($monthlyRevenue as $item)
                        <div class="chart-column" title="{{ number_format($item['revenue'], 0, ',', '.') }} VNĐ">
                            <span style="height: {{ $item['percentage'] }}%;"></span>
                            <small>{{ $item['month_name'] }}</small>
                        </div>
                    @endforeach
                </div>
              </div>
            </div>

            <div class="col-12 col-xl-4">
              <div class="panel h-100">
                <div class="panel-header">
                  <div>
                    <h2 class="h5 mb-1 section-title"><i class="bi bi-activity" aria-hidden="true"></i><span>Team
                        Activity</span></h2>
                    <p class="text-muted mb-0">Recent operational updates.</p>
                  </div>
                </div>

                <div class="activity-list">
                  <div class="activity-item"><span class="activity-dot bg-primary"></span>
                    <div>
                      <p class="mb-1 fw-semibold">New campaign launched</p>
                      <p class="text-muted small mb-0">Marketing team published the May offer.</p>
                    </div>
                  </div>
                  <div class="activity-item"><span class="activity-dot bg-success"></span>
                    <div>
                      <p class="mb-1 fw-semibold">Payment batch cleared</p>
                      <p class="text-muted small mb-0">246 invoices were processed successfully.</p>
                    </div>
                  </div>
                  <div class="activity-item"><span class="activity-dot bg-warning"></span>
                    <div>
                      <p class="mb-1 fw-semibold">Support queue rising</p>
                      <p class="text-muted small mb-0">Average first response time is 18 minutes.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="panel mt-3">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Người dùng gần đây</span></h2>
                <p class="text-muted mb-0">Các tài khoản đã tạo gần đây.</p>
              </div>
              <a class="btn btn-outline-secondary btn-sm" href=" {{ route('admin.customers') }}">Xem tất cả khách hàng</a>
              <a class="btn btn-outline-secondary btn-sm" href=" {{ route('admin.staffs') }}">Xem tất cả nhân viên</a>           
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead>
                  <tr>
                    <th scope="col">Người dùng</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Nhóm</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tham gia</th>
                    <th scope="col" class="text-end">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentUsers as $user)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <img class="avatar-img avatar-sm"
                            src="{{ $user->avata ? asset($user->avata) : asset('admin_assets/images/avatar/default.jpg') }}"
                            alt="{{ $user->name }}">
                          <div>
                            <p class="fw-semibold mb-0">{{ $user->name }}</p>
                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        @if($user->role == 'admin')
                          <span class="badge text-bg-danger">Admin</span>
                        @elseif($user->role == 'customer')
                          <span class="badge text-bg-primary">Customer</span>
                        @else
                          <span class="badge text-bg-secondary">Staff</span>
                        @endif
                      </td>
                      <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                      <td>
                        @if($user->status == 1)
                          <span class="badge text-bg-success">Active</span>
                        @else
                          <span class="badge text-bg-secondary">Locked</span>
                        @endif
                      </td>
                      <td>{{ $user->created_at->format('d/m/Y') }}</td>
                      <td class="text-end">
                      @if($user->role == 'customer')
                        <a class="btn btn-light btn-sm" href="{{ route('admin.customers') }}">Xem</a>
                      @elseif($user->role == 'staff')
                        <a class="btn btn-light btn-sm" href="{{ route('admin.staffs') }}">Xem</a>
                      @else
                        <a class="btn btn-light btn-sm" href="{{ route('admin.profile') }}">Xem</a>
                      @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </main>
    </div>
  </div>

@endsection