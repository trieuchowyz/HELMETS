@extends('admin.layout.app')

@section('content')
  <div class="admin-shell">
    <div class="admin-main">
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Tài khoản</p>
                <h1 class="h3 mb-1">Hồ sơ cá nhân (Profile)</h1>
                <p class="text-muted mb-0">Quản lý thông tin cá nhân, ảnh đại diện và bảo mật.</p>
              </div>
            </div>
          </div>

          @if(session('success'))
              <div class="alert alert-success mt-3"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
          @endif
          @if($errors->any())
              <div class="alert alert-danger mt-3">Vui lòng kiểm tra lại thông tin nhập!</div>
          @endif

          <section class="row g-4 mt-1">
            
            <!-- CỘT TRÁI: HIỂN THỊ THÔNG TIN -->
            <div class="col-12 col-xl-4">
              <div class="panel h-100 text-center profile-card p-4">
                <div class="profile-hero">
                  <img class="avatar-img avatar-xl profile-photo mb-3 border shadow-sm" 
                       src="{{ $admin->avata ? asset($admin->avata) : asset('admin_assets/images/avatar/default.jpg') }}" 
                       alt="Avatar" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
                  
                  <h2 class="h5 mt-3 mb-1">{{ $admin->name }}</h2>
                  <p class="text-muted mb-3">{{ $admin->email }}</p>
                  
                  <div class="d-flex justify-content-center gap-2">
                      <span class="badge text-bg-danger">Giám đốc (Admin)</span>
                      <span class="badge text-bg-success">Đã xác minh</span>
                  </div>
                </div>
                
                <hr class="my-4">
                
                <div class="info-list text-start small">
                  <div class="d-flex justify-content-between border-bottom py-2">
                      <span class="text-muted">Ngày bắt đầu:</span>
                      <strong class="text-dark">{{ $admin->created_at->format('d/m/Y') }}</strong>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                      <span class="text-muted">Trạng thái:</span>
                      <strong class="text-success">Đang hoạt động</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- CỘT PHẢI: FORM CẬP NHẬT -->
            <div class="col-12 col-xl-8">
              <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="panel">
                @csrf
                <div class="panel-header border-bottom p-3">
                  <div>
                    <h2 class="h5 mb-1 section-title"><i class="bi bi-person-gear me-2" aria-hidden="true"></i>Cài đặt Hồ sơ</h2>
                  </div>
                </div>
                
                <div class="p-4 row g-4">
                  <!-- Cập nhật Ảnh đại diện -->
                  <div class="col-12">
                      <label class="form-label fw-semibold">Ảnh đại diện mới</label>
                      <input class="form-control" type="file" name="avata" accept="image/*">
                      <small class="text-muted">Định dạng JPEG, PNG, JPG, WEBP. Tối đa 2MB.</small>
                  </div>

                  <!-- Thông tin cơ bản -->
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Họ và Tên</label>
                    <input class="form-control" name="name" type="text" value="{{ $admin->name }}" required>
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Email đăng nhập</label>
                    <input class="form-control" name="email" type="email" value="{{ $admin->email }}" required>
                  </div>

                  <!-- Đổi mật khẩu -->
                  <div class="col-12 mt-4">
                      <h6 class="border-bottom pb-2 mb-3">Bảo mật tài khoản</h6>
                      <label class="form-label fw-semibold">Đổi mật khẩu mới</label>
                      <input class="form-control w-50" name="password" type="password" placeholder="Bỏ trống nếu không muốn đổi...">
                  </div>
                </div>

                <div class="panel-footer text-end p-3 border-top">
                  <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1" aria-hidden="true"></i> Lưu thay đổi</button>
                </div>
              </form>
            </div>
          </section>

        </div>
      </main>
    </div>
  </div>
@endsection