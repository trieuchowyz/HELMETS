@extends('admin.layouts.app')
@section('title', 'Cập nhật Mũ/Nón')

@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom"><h6 class="mb-0 fw-bold">Hình ảnh sản phẩm</h6></div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    
                    <div class="border rounded bg-light d-flex justify-content-center align-items-center p-2 mb-3 w-100" style="min-height: 350px;">
                        <img id="img-preview" src="{{ asset($product->img ?? 'https://via.placeholder.com/400x400?text=Chưa+chọn+ảnh') }}" class="img-fluid rounded w-100" style="object-fit: contain; max-height: 350px;">
                    </div>

                    <div class="w-100">
                        <label class="form-label fw-bold">Tải ảnh mới (Bỏ trống nếu giữ ảnh cũ)</label>
                        <input type="file" name="img_upload" id="img_upload" class="form-control mb-2" accept="image/*">
                        
                        <label class="form-label text-muted mt-2">Link ảnh ngoài</label>
                        <input type="text" name="img" class="form-control form-control-sm" value="{{ $product->img }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Thông tin chi tiết</h6>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Cập nhật thay đổi</button>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control form-control-lg fw-bold" value="{{ $product->name }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select name="catid" class="form-select" required>
                                <option value="">-- Chọn danh mục nón --</option>
                                @foreach($categories as $cat)
                                    @if(empty($cat->parentid))
                                        @php $children = $categories->where('parentid', $cat->id); @endphp
                                        
                                        @if($children->count() > 0)
                                            <optgroup label="Mục: {{ $cat->name }}">
                                                @foreach($children as $child)
                                                    <option value="{{ $child->id }}" {{ $product->catid == $child->id ? 'selected' : '' }}>
                                                        --- {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{ $cat->id }}" {{ $product->catid == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giá bán (VNĐ)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control text-primary fw-bold" value="{{ $product->price }}" required>
                                <span class="input-group-text">VND</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>

                    <div class="bg-light p-3 rounded mb-4 border">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Thông số kỹ thuật</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text w-25">Size</span>
                                    <input type="text" name="specs[size]" class="form-control" value="{{ $product->specs['size'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text w-25">Màu</span>
                                    <input type="text" name="specs[color]" class="form-control" value="{{ $product->specs['color'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text w-25">Chất liệu</span>
                                    <input type="text" name="specs[material]" class="form-control" value="{{ $product->specs['material'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text w-25">Trọng lượng</span>
                                    <input type="text" name="specs[weight]" class="form-control" value="{{ $product->specs['weight'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="detail" rows="5" class="form-control">{{ $product->detail }}</textarea>
                    </div>

                    <a href="{{ route('admin.products') }}" class="btn btn-link text-decoration-none text-muted p-0 mt-2">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection