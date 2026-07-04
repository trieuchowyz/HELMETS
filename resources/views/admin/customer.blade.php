@extends('admin.layout.app')

@section('content')
  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading d-flex justify-content-between align-items-center">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Tài khoản</p>
                <h1 class="h3 mb-1">Khách Hàng</h1>
                <p class="text-muted mb-0">Quản lý tài khoản người mua và hỗ trợ khi cần thiết.</p>
              </div>
            </div>
          </div>

          @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
          @endif

          <section class="row g-3 mt-1" aria-label="User summary">
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Tổng Khách Hàng</span>
                  <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $totalCustomers }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Đang Hoạt Động</span>
                  <span class="metric-icon"><i class="bi bi-check2-circle" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $activeCustomers }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-warning">
                <div class="metric-top">
                  <span class="metric-label">Khách Mới (Tháng này)</span>
                  <span class="metric-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $newThisMonth }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-danger">
                <div class="metric-top">
                  <span class="metric-label">Tài Khoản Bị Khóa</span>
                  <span class="metric-icon"><i class="bi bi-slash-circle" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $lockedCustomers }}</div>
              </article>
            </div>
          </section>

          <section class="panel mt-3">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Danh sách Khách Hàng</span></h2>
              </div>
              <div class="d-flex flex-wrap gap-2">
                <input class="form-control form-control-sm table-search" type="search" placeholder="Tìm tên, email..." data-table-search="usersTable">
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0" id="usersTable" data-searchable-table>
                <thead class="table-light">
                  <tr>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày đăng ký</th>
                    <th scope="col" class="text-end">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($customers as $cus)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img class="avatar-img avatar-sm" src="{{ $cus->avata ? asset($cus->avata) : asset('admin_assets/images/avatar/default.jpg') }}" alt="">
                        <div>
                          <p class="fw-semibold mb-0">{{ $cus->name }}</p>
                          <p class="text-muted small mb-0">{{ $cus->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>{{ $cus->phone ?? 'Chưa cập nhật' }}</td>
                    <td>
                        @if($cus->status == 1) <span class="badge text-bg-success">Hoạt động</span>
                        @else <span class="badge text-bg-secondary">Đã khóa</span>
                        @endif
                    </td>
                    <td>{{ $cus->created_at->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.customers.show', $cus->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Xem Lịch sử</a>
                        <form action="{{ route('admin.customers.toggle', $cus->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn đổi trạng thái khách hàng này?');">
                            @csrf
                            <button class="btn btn-sm {{ $cus->status == 1 ? 'btn-outline-danger' : 'btn-success' }}">
                                <i class="bi bi-{{ $cus->status == 1 ? 'lock' : 'unlock' }}"></i>
                            </button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="p-3">{{ $customers->links('pagination::bootstrap-5') }}</div>
          </section>
        </div>
      </main>
    </div>
  </div>
@endsection