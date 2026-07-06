@extends('admin.layout.app')

@section('content')

      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading">
          <a href="{{ route('admin.staffs') }}" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Quay lại</a>
          <h1 class="h3 mb-1">Hồ Sơ Nhân Viên: {{ $staff->name }}</h1>
          <p class="text-muted">Cập nhật thông tin cá nhân, lương thưởng và bảo mật.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin nhập!</div>
        @endif

        <div class="row g-4 mt-2">
            <div class="col-xl-4">
                <div class="panel text-center p-4">
                    <img src="{{ $staff->avata ? asset($staff->avata) : asset('admin_assets/images/avatar/default.jpg') }}" alt="Avatar" class="rounded-circle mb-3 border shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="mb-1">{{ $staff->name }}</h5>
                    <p class="text-muted small mb-3">{{ $staff->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        @if($staff->status == 1) <span class="badge text-bg-success">Tài khoản Mở</span>
                        @else <span class="badge text-bg-danger">Tài khoản Khóa</span> @endif

                        <span class="badge text-bg-dark text-uppercase">{{ $staff->role }}</span>
                    </div>

                    <ul class="list-group list-group-flush text-start small">
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Ngày vào làm:</span>
                            <span class="fw-semibold">{{ $staff->hire_date ? \Carbon\Carbon::parse($staff->hire_date)->format('d/m/Y') : 'Chưa cập nhật' }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Mức lương:</span>
                            <span class="fw-semibold text-success">{{ number_format($staff->salary, 0, ',', '.') }} VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="panel p-4">
                    <h5 class="mb-4 border-bottom pb-2">Chỉnh Sửa Thông Tin</h5>
                    <form action="{{ route('admin.staffs.update', $staff->id) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và Tên</label>
                                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email (Dùng đăng nhập)</label>
                                <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ $staff->address }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Phân Quyền (Role)</label>
                                <select name="role" class="form-select" required>
                                    <option value="staff" {{ $staff->role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                                    <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Quản lý</option>
                                    <option value="admin" {{ $staff->role == 'admin' ? 'selected' : '' }}>Giám đốc</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Lương cơ bản (VNĐ)</label>
                                <input type="number" name="salary" class="form-control" value="{{ $staff->salary }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ngày vào làm</label>
                                <input type="date" name="hire_date" class="form-control" value="{{ $staff->hire_date ? \Carbon\Carbon::parse($staff->hire_date)->format('Y-m-d') : '' }}">
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="border-bottom pb-2">Đổi Mật Khẩu (Tùy chọn)</h6>
                                <p class="small text-muted mb-2">Bỏ trống nếu không muốn thay đổi mật khẩu của nhân viên này.</p>
                                <input type="password" name="password" class="form-control w-50" placeholder="Nhập mật khẩu mới...">
                            </div>

                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> Cập Nhật Hồ Sơ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>

@endsection