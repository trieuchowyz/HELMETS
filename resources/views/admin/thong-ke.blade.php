@extends('admin.layout.app')

@section('content')
  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Phân tích</p>
                <h1 class="h3 mb-1">Thống kê dữ liệu</h1>
                <p class="text-muted mb-0">Trực quan hóa doanh thu và hiệu suất bán hàng.</p>
              </div>
            </div>
          </div>

          <section class="row g-3 mt-1">          
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
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-pie-chart" aria-hidden="true"></i><span>Tỷ lệ Đơn hàng</span></h2>
                        <p class="text-muted mb-0">Phân bổ theo trạng thái xử lý.</p>
                    </div>
                </div>
                
                @php
                    // Tính % cho phần ở giữa biểu đồ tròn (hiển thị % đơn đã hoàn thành)
                    $completedPct = $totalOrders > 0 ? round(($orderStats['completed'] / $totalOrders) * 100) : 0;
                @endphp
                
                <div class="donut-chart mx-auto"><span>{{ $completedPct }}%</span></div>
                
                <div class="legend-list mt-4">
                    <div>
                        <span class="legend-dot bg-success"></span>Hoàn thành 
                        <strong>{{ $orderStats['completed'] }} đơn</strong>
                    </div>
                    <div>
                        <span class="legend-dot bg-primary"></span>Đang giao 
                        <strong>{{ $orderStats['shipped'] }} đơn</strong>
                    </div>
                    <div>
                        <span class="legend-dot bg-warning"></span>Chờ xử lý 
                        <strong>{{ $orderStats['pending'] }} đơn</strong>
                    </div>
                </div>
              </div>
            </div>

          </section>
        </div>
      </main>
    </div>
  </div>
@endsection