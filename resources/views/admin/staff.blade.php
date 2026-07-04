@extends('admin.layout.app')

@section('content')
  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <div class="page-heading d-flex justify-content-between align-items-center">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Nhân sự</p>
                <h1 class="h3 mb-1">Quản lý Nhân Viên</h1>
                <p class="text-muted mb-0">Quản lý tài khoản, phân quyền và lương thưởng nội bộ.</p>
              </div>
            </div>
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal"><i class="bi bi-person-plus"></i> Thêm Nhân Viên</button>
            </div>
          </div>

          @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
          @endif

          <section class="row g-3 mt-1">
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Tổng Nhân sự</span>
                  <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $totalStaff }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Đang làm việc</span>
                  <span class="metric-icon"><i class="bi bi-check2-circle" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $activeStaff }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-warning">
                <div class="metric-top">
                  <span class="metric-label">Quản trị viên (Admin)</span>
                  <span class="metric-icon"><i class="bi bi-shield-lock" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $adminCount }}</div>
              </article>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <article class="metric-card metric-danger">
                <div class="metric-top">
                  <span class="metric-label">Đã khóa / Nghỉ việc</span>
                  <span class="metric-icon"><i class="bi bi-slash-circle" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $lockedStaff }}</div>
              </article>
            </div>
          </section>

          <section class="panel mt-4">
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Nhân viên</th>
                    <th>Chức vụ</th>
                    <th>Mức lương</th>
                    <th>Trạng thái</th>
                    <th>Ngày vào làm</th>
                    <th class="text-end">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($staffs as $staff)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img class="avatar-img avatar-sm" src="{{ $staff->avata ? asset($staff->avata) : asset('admin_assets/images/avatar/default.jpg') }}" alt="">
                        <div>
                          <p class="fw-semibold mb-0">{{ $staff->name }}</p>
                          <p class="text-muted small mb-0">{{ $staff->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                        @if($staff->role == 'admin') <span class="badge text-bg-danger">Giám đốc (Admin)</span>
                        @elseif($staff->role == 'manager') <span class="badge text-bg-primary">Quản lý</span>
                        @else <span class="badge text-bg-info">Nhân viên</span>
                        @endif
                    </td>
                    <td class="fw-semibold text-success">{{ number_format($staff->salary, 0, ',', '.') }}đ</td>
                    <td>
                        @if($staff->status == 1) <span class="badge text-bg-success">Đang làm</span>
                        @else <span class="badge text-bg-secondary">Đã khóa</span>
                        @endif
                    </td>
                    <td>{{ $staff->hire_date ? \Carbon\Carbon::parse($staff->hire_date)->format('d/m/Y') : 'N/A' }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.staffs.show', $staff->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i> Xem/Sửa</a>
                        <form action="{{ route('admin.staffs.toggle', $staff->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm {{ $staff->status == 1 ? 'btn-outline-danger' : 'btn-success' }}">
                                <i class="bi bi-{{ $staff->status == 1 ? 'lock' : 'unlock' }}"></i>
                            </button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="p-3">{{ $staffs->links('pagination::bootstrap-5') }}</div>
          </section>
        </div>
      </main>
    </div>
  </div>

  <div class="modal fade" id="addStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.staffs.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Thêm Nhân Viên Mới</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <label class="form-label">Họ và Tên *</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email đăng nhập *</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Mật khẩu khởi tạo *</label>
              <input type="password" name="password" class="form-control" required minlength="6">
            </div>
            <div class="col-md-6">
              <label class="form-label">Số điện thoại</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Phân quyền chức vụ *</label>
              <select name="role" class="form-select" required>
                <option value="staff">Nhân viên (Staff)</option>
                <option value="manager">Quản lý (Manager)</option>
                <option value="admin">Giám đốc (Admin)</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Mức lương cơ bản (đ)</label>
              <input type="number" name="salary" class="form-control" value="0">
            </div>
            <div class="col-md-4">
              <label class="form-label">Ngày vào làm</label>
              <input type="date" name="hire_date" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu nhân viên</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection