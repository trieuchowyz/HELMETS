@extends('admin.layout.app')

@section('content')
<div class="admin-shell">
  <div class="admin-main">
    <main class="dashboard-content">
      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading d-flex justify-content-between align-items-center">
          <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
            <div>
              <p class="eyebrow mb-1">Kinh doanh</p>
              <h1 class="h3 mb-1">Quản lý Sản phẩm</h1>
              <p class="text-muted mb-0">Quản lý kho hàng, cập nhật giá và số lượng nhanh.</p>
            </div>
          </div>
          <div>
            <a href="{{ route('admin.sanpham.hidden') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-archive"></i> Kho SP Ẩn/Hết hàng</a>
            <a href="{{ route('admin.sanpham.bulkCreate') }}" class="btn btn-primary"><i class="bi bi-list-columns-reverse"></i> Thêm Hàng Loạt</a>
          </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <section class="panel mt-4">
          <div class="panel-header d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.sanpham') }}" method="GET" class="d-flex gap-2">
              <select name="catid" class="form-select form-select-sm" style="width: 200px;">
                <option value="">-- Tất cả danh mục --</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ request('catid') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
              <button type="submit" class="btn btn-sm btn-dark">Lọc</button>
            </form>
          </div>
          
          <form action="{{ route('admin.sanpham.bulkUpdate') }}" method="POST">
            @csrf
            <div class="table-responsive">
              <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th style="width: 40px;">Tick</th>
                    <th>Hình & Tên Sản Phẩm</th>
                    <th>Danh mục</th>
                    <th style="width: 150px;">Giá bán (đ)</th>
                    <th style="width: 150px;">Giá KM (đ)</th>
                    <th style="width: 100px;">Kho</th>
                    <th class="text-end">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $prod)
                  <tr>
                    <td>
                      <input class="form-check-input" type="checkbox" name="products[{{ $prod->id }}][selected]" value="1">
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <img src="{{ $prod->img ? asset($prod->img) : asset('admin_assets/images/no-image.jpg') }}" alt="" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                          <p class="fw-semibold mb-0" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $prod->name }}</p>
                          <small class="text-muted">SKU: {{ $prod->sku ?? 'N/A' }}</small>
                        </div>
                      </div>
                    </td>
                    <td>{{ $prod->category->name ?? 'Không rõ' }}</td>
                    <td>
                      <input type="number" name="products[{{ $prod->id }}][price]" class="form-control form-control-sm" value="{{ $prod->price }}">
                    </td>
                    <td>
                      <input type="number" name="products[{{ $prod->id }}][sale_price]" class="form-control form-control-sm" value="{{ $prod->sale_price }}">
                    </td>
                    <td>
                      <input type="number" name="products[{{ $prod->id }}][quantity]" class="form-control form-control-sm" value="{{ $prod->quantity }}">
                    </td>
                    <td class="text-end">
                        <button type="submit" formaction="{{ route('admin.sanpham.toggle', $prod->id) }}" class="btn btn-sm btn-outline-danger" title="Ẩn sản phẩm"><i class="bi bi-eye-slash"></i> Ẩn</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="panel-footer d-flex justify-content-between align-items-center mt-3 p-3 border-top">
              <div>
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
              </div>
              <button type="submit" class="btn btn-success me-2"><i class="bi bi-save me-1"></i> Lưu nhanh ô đã sửa</button>
                
              <button type="submit" formaction="{{ route('admin.sanpham.bulkEdit') }}" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i> Sửa Nâng Cao Hàng Loạt</button>
            </div>
          </form>

        </section>
      </div>
    </main>
  </div>
</div>

@endsection