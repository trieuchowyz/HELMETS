@extends('layouts.main')
@section('noidungwebsite')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5 shadow-sm">
                    <div class="text-center mb-4">
                        <h2 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Chào mừng trở lại!</h2>
                        <p class="mb-0 mt-3 text-muted">Vui lòng đăng nhập để tiếp tục</p>
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

                    @if (session('success'))
                        <div class="alert alert-success rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="fw-bold mb-2">Tên đăng nhập / Email <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="Nhập tài khoản của bạn..." required>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold mb-2">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control border-0 rounded-pill w-100 py-3 px-4" placeholder="Nhập mật khẩu..." required>
                        </div>

                        <div class="text-center mt-4">
                            <input type="submit" value="Đăng nhập" class="btn btn-primary rounded-pill py-3 px-5 w-100 mb-4 fw-bold" />
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <a href="#" class="text-muted text-decoration-none hover-primary">Quên mật khẩu?</a>
                            <span>Chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Đăng ký ngay</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection