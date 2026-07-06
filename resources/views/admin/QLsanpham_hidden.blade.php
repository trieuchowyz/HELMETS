@extends('admin.layout.app')

@section('content')

      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading d-flex justify-content-between align-items-center">
          <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-archive" aria-hidden="true"></i></span>
            <div>
              <p class="eyebrow mb-1">Kho lưu trữ</p>
              <h1 class="h3 mb-1">Sản Phẩm Đã Ẩn</h1>
              <p class="text-muted mb-0">Danh sách các sản phẩm ngừng kinh doanh hoặc tạm ẩn.</p>
            </div>
          </div>
          <a href="{{ route('admin.sanpham') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Quay lại danh sách chính</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <section class="panel mt-4">
          <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>Hình & Tên Sản Phẩm</th>
                  <th>Danh mục</th>
                  <th>Giá bán</th>
                  <th class="text-end">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @forelse($products as $prod)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="{{ $prod->img ? asset($prod->img) : asset('admin_assets/images/no-image.jpg') }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                      <p class="fw-semibold mb-0">{{ $prod->name }}</p>
                    </div>
                  </td>
                  <td>{{ $prod->category->name ?? 'Không rõ' }}</td>
                  <td><del class="text-muted">{{ number_format($prod->price, 0, ',', '.') }} đ</del></td>
                  <td class="text-end">
                      <form action="{{ route('admin.sanpham.toggle', $prod->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-arrow-counterclockwise"></i> Khôi phục</button>
                      </form>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Không có sản phẩm nào đang ẩn.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="p-3">{{ $products->links('pagination::bootstrap-5') }}</div>
        </section>
      </div>

@endsection