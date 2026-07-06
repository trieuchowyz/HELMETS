@extends('admin.layout.app')

@section('content')

      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading d-flex justify-content-between align-items-center">
          <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
            <div>
              <p class="eyebrow mb-1">Sản phẩm</p>
              <h1 class="h3 mb-1">Quản lý Danh mục</h1>
              <p class="text-muted mb-0">Phân loại nón bảo hiểm theo nhóm cha - con.</p>
            </div>
          </div>
          <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
              <i class="bi bi-plus-lg"></i> Thêm Danh Mục
            </button>
          </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
        @endif

        <section class="panel mt-4">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Tên danh mục</th>
                  <th>Cấp độ</th>
                  <th>Trạng thái</th>
                  <th class="text-end">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $parent)
                  <tr>
                    <td class="fw-bold text-primary fs-6">{{ $parent->name }}</td>
                    <td><span class="badge text-bg-dark">Danh mục gốc (Cha)</span></td>
                    <td>
                        @if($parent->status == 1)
                            <span class="badge text-bg-success">Đang hiện</span>
                        @else
                            <span class="badge text-bg-secondary">Đã tắt</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $parent->id }}">Sửa</button>
                        <form action="{{ route('admin.danhmuc.toggle', $parent->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $parent->status == 1 ? 'btn-outline-danger' : 'btn-success' }}">
                                {{ $parent->status == 1 ? 'Tắt' : 'Bật' }}
                            </button>
                        </form>
                    </td>
                  </tr>

                  @foreach($parent->children as $child)
                  <tr>
                    <td>
                        <span class="ms-4 text-muted"><i class="bi bi-arrow-return-right me-2"></i>{{ $child->name }}</span>
                    </td>
                    <td><span class="badge border border-secondary text-secondary">Danh mục con</span></td>
                    <td>
                        @if($child->status == 1)
                            <span class="badge text-bg-success">Đang hiện</span>
                        @else
                            <span class="badge text-bg-secondary">Đã tắt</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $child->id }}">Sửa</button>
                        <form action="{{ route('admin.danhmuc.toggle', $child->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $child->status == 1 ? 'btn-outline-danger' : 'btn-success' }}">
                                {{ $child->status == 1 ? 'Tắt' : 'Bật' }}
                            </button>
                        </form>
                    </td>
                  </tr>

                  <div class="modal fade" id="editModal{{ $child->id }}" tabindex="-1" aria-hidden="true">
                    @include('admin.partials.category_edit_modal', ['cat' => $child, 'parents' => $parentCategories])
                  </div>
                  @endforeach

                  <div class="modal fade" id="editModal{{ $parent->id }}" tabindex="-1" aria-hidden="true">
                    @include('admin.partials.category_edit_modal', ['cat' => $parent, 'parents' => $parentCategories])
                  </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>

      </div>


<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.danhmuc.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Thêm Danh Mục Mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Tên danh mục (Ví dụ: Nón Sơn, Mũ 3/4)</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Chọn danh mục cha (Bỏ trống nếu là cấp cao nhất)</label>
            <select name="parentid" class="form-select">
              <option value="">-- Đây là danh mục gốc --</option>
              @foreach($parentCategories as $pCat)
                <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Lưu danh mục</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection