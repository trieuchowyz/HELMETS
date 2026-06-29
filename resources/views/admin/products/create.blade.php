@extends('admin.layouts.app')
@section('title', 'Thêm Mũ/Nón Mới')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom"><h6 class="mb-0 fw-bold">Hình ảnh sản phẩm</h6></div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    
                    <div class="border rounded bg-light d-flex justify-content-center align-items-center p-2 mb-3 w-100" style="min-height: 350px;">
                        <img id="img-preview" src="https://via.placeholder.com/400x400?text=Chưa+chọn+ảnh" class="img-fluid rounded w-100" style="object-fit: contain; max-height: 350px;">
                    </div>

                    <div class="w-100">
                        <label class="form-label fw-bold">Tải ảnh lên từ máy tính (Ưu tiên)</label>
                        <input type="file" name="img_upload" id="img_upload" class="form-control mb-2" accept="image/*">
                        
                        <!-- <label class="form-label text-muted mt-2">Hoặc nhập link ảnh (tùy chọn)</label>
                        <input type="text" name="img" class="form-control form-control-sm" placeholder="https://..."> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Thông tin chi tiết</h6>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Lưu sản phẩm</button>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control form-control-lg fw-bold" required placeholder="VD: Mũ Fullface Royal M138B - Size L">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label class="form-label">Danh mục</label>
                            <select name="catid" class="form-select" required>
                                <option value="">-- Chọn danh mục nón --</option>
                                @foreach($categories as $cat)
                                    @if(empty($cat->parentid))
                                        @php $children = $categories->where('parentid', $cat->id); @endphp
                                        
                                        @if($children->count() > 0)
                                            <optgroup label="Mục: {{ $cat->name }}">
                                                @foreach($children as $child)
                                                    <option value="{{ $child->id }}">--- {{ $child->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Giá bán (VNĐ)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control text-primary fw-bold" required placeholder="850000">
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control fw-bold" required min="0" value="10">
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <span class="ms-2 text-muted"></span>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="detail" rows="5" class="form-control" placeholder="Viết bài giới thiệu về sản phẩm này..."></textarea>
                    </div>

                    <a href="{{ route('admin.products') }}" class="btn btn-link text-decoration-none text-muted ms-3">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection