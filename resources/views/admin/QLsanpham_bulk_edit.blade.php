@extends('admin.layout.app')

@section('content')

                <div class="container-fluid px-3 px-lg-4 py-4">

                    <div class="page-heading">
                        <h1 class="h3 mb-1">Sửa Sản Phẩm Hàng Loạt</h1>
                        <p class="text-muted">Chỉnh sửa hình ảnh, tên, danh mục và giá của các sản phẩm đã chọn.</p>
                    </div>

                    <form action="{{ route('admin.sanpham.updateBulkAdvanced') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <section class="panel mt-4">

                            <div class="panel-header bg-light border-bottom p-3">
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="fw-bold"><i class="bi bi-magic me-1"></i> Áp dụng chung cho các ô đã
                                        Tick:</span>
                                    <select id="bulkCat" class="form-select form-select-sm w-auto">
                                        <option value="">-- Danh mục --</option>
                                        @foreach($categories as $cat) <option value="{{ $cat->id }}">{{ $cat->name }}
                                        </option> @endforeach
                                    </select>
                                    <input type="number" id="bulkPrice" class="form-control form-control-sm w-auto"
                                        placeholder="Giá chung...">
                                    <input type="number" id="bulkQty" class="form-control form-control-sm w-auto"
                                        placeholder="Kho chung...">
                                    <button type="button" class="btn btn-sm btn-dark" onclick="applyToSelected()">Áp
                                        dụng</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 40px;"><input type="checkbox" id="selectAll"
                                                    class="form-check-input" checked></th>
                                            <th style="width: 150px;">Đổi Ảnh mới</th>
                                            <th>Tên SP</th>
                                            <th style="width: 180px;">Danh mục</th>
                                            <th style="width: 130px;">Giá bán</th>
                                            <th style="width: 100px;">Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedProducts as $prod)
                                            <tr class="{{ $prod->quantity <= 0 ? 'bg-light text-muted' : '' }}"
                                                style="{{ $prod->quantity <= 0 ? 'opacity: 0.6;' : '' }}">
                                                <td><input class="form-check-input row-checkbox" type="checkbox" checked></td>
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        <img src="{{ asset($prod->img) }}" alt=""
                                                            style="width: 40px; height: 40px; object-fit: cover;"
                                                            class="rounded border">
                                                        <input type="file" name="products[{{ $prod->id }}][img]"
                                                            class="form-control form-control-sm" accept="image/*">
                                                    </div>
                                                </td>
                                                <td><input type="text" name="products[{{ $prod->id }}][name]"
                                                        class="form-control form-control-sm" value="{{ $prod->name }}" required>
                                                </td>
                                                <td>
                                                    <select name="products[{{ $prod->id }}][catid]"
                                                        class="form-select form-select-sm cat-select">
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $prod->catid == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="products[{{ $prod->id }}][price]"
                                                        class="form-control form-control-sm price-input"
                                                        value="{{ $prod->price }}" required></td>
                                                <td><input type="number" name="products[{{ $prod->id }}][quantity]"
                                                        class="form-control form-control-sm qty-input"
                                                        value="{{ $prod->quantity }}" required></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="panel-footer p-3 text-end border-top">
                                <a href="{{ route('admin.sanpham') }}" class="btn btn-secondary me-2">Hủy</a>
                                <button type="submit" class="btn btn-warning"><i class="bi bi-check-circle"></i> Cập nhật
                                    các SP trên</button>
                            </div>
                        </section>
                    </form>

                </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#selectAll').click(function () {
            $('.row-checkbox').prop('checked', this.checked);
        });

        function applyToSelected() {
            let price = $('#bulkPrice').val();
            let qty = $('#bulkQty').val();
            let cat = $('#bulkCat').val();

            $('.row-checkbox:checked').each(function () {
                let tr = $(this).closest('tr');
                if (price !== "") tr.find('.price-input').val(price);
                if (qty !== "") tr.find('.qty-input').val(qty);
                if (cat !== "") tr.find('.cat-select').val(cat);
            });
        }
    </script>
@endsection