<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="{{ url('/') }}" class="navbar-brand p-0">
                    <h1 class="display-5 text-primary m-0"><i
                            class="fas fa-shopping-bag text-secondary me-2"></i>NVT</h1>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <div class="d-flex border rounded-pill">
                    <input class="form-control border-0 rounded-pill w-100 py-3" type="text"
                        placeholder="Tìm kiếm linh kiện...">
                    <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <a href="{{ url('/') }}" class="navbar-brand d-block d-lg-none">
                    <h1 class="display-5 text-secondary m-0"><i
                            class="fas fa-shopping-bag text-white me-2"></i>NVT</h1>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <div class="navbar-nav me-auto py-0">
                        @foreach ($menus as $i)
                            @if ($i->menuCon && $i->menuCon->count() > 0)
                                <div class="nav-item dropdown">
                                    <a href="{{ url($i->slug == '/' ? '/' : $i->slug) }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $i->name }}</a>
                                    <div class="dropdown-menu m-0">
                                        @foreach ($i->menuCon as $j)
                                            <a href="{{ url($j->slug) }}" class="dropdown-item">{{ $j->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ url($i->slug == '/' ? '/' : $i->slug) }}" class="nav-item nav-link">{{ $i->name }}</a>
                            @endif
                        @endforeach
                    </div>

                    <div class="navbar-nav py-0 align-items-lg-center">
                        <a href="{{ route('home.cart') }}" class="nav-item nav-link"><i class="fas fa-shopping-cart me-1"></i> Giỏ hàng</a>

                        <div class="nav-item dropdown ms-lg-3">
                            @guest
                                <a href="#" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0 dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i> Tài khoản
                                </a>
                                <div class="dropdown-menu m-0 border-0 shadow-sm dropdown-menu-end">
                                    <a href="{{ route('login') }}" class="dropdown-item"><i class="fas fa-sign-in-alt me-2"></i> Đăng nhập</a>
                                    <a href="{{ route('register') }}" class="dropdown-item"><i class="fas fa-user-plus me-2"></i> Đăng ký</a>
                                </div>
                            @else
                                <a href="#" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0 dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-check me-2"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu m-0 border-0 shadow-sm dropdown-menu-end">
                                    <a href="{{ route('account.index') }}" class="dropdown-item"><i class="fas fa-clipboard-list me-2"></i> Lịch sử đơn hàng</a>
                                    <a href="{{ route('logout') }}" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
                                </div>
                            @endguest
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>