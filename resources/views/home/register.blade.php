@extends('layouts.main')
@section('noidungwebsite')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5 shadow-sm">
                    <div class="text-center mb-4">
                        <h2 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Đăng ký tài khoản</h2>
                        <p class="mb-0 mt-3 text-muted">Trở thành thành viên của Shop Nón</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="VD: Nguyễn Văn Triều" required>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="VD: 0912345678" pattern="[0-9]{10,11}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="pass" class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="pass" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="Nhập mật khẩu..." required>
                            </div>

                            <div class="col-md-6">
                                <label for="confirmPass" class="form-label fw-bold">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="confirmPass" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="Nhập lại..." required>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <input type="submit" value="Tạo tài khoản" class="btn btn-primary rounded-pill py-3 px-5 w-100 fw-bold">
                        </div>
                        
                        <div class="text-center mt-4 border-top pt-3">
                            <span class="text-muted">Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Đăng nhập tại đây</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection