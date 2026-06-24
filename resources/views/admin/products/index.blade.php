@extends('admin.layouts.app')
@section('title', 'Quản lý Linh kiện PC')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Danh sách linh kiện</h6>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên linh kiện</th>
                        <th>Danh mục</th>
                        <th>Giá bán</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>
                            <img src="{{ $item->img }}" alt="" width="50" class="rounded">
                        </td>
                        <td class="fw-bold">{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? 'Không rõ' }}</td>
                        <td class="text-danger fw-bold">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-outline-info" title="Sửa"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.products.delete', $item->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa linh kiện này?')" title="Xóa"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white pt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection