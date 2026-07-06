@extends('admin.layout.app')

@section('content')

      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading">
          <h1 class="h3 mb-1">Thêm Sản Phẩm Hàng Loạt</h1>
          <p class="text-muted">Nhập thông tin kiểu danh sách, áp dụng chung giá trị để tiết kiệm thời gian.</p>
        </div>

        <form action="{{ route('admin.sanpham.storeBulk') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <section class="panel mt-4">
            
            <div class="panel-header bg-light border-bottom p-3">
                <div class="d-flex gap-3 align-items-center">
                    <span class="fw-bold"><i class="bi bi-magic me-1"></i> Áp dụng cho các ô đã Tick:</span>
                    <select id="bulkCat" class="form-select form-select-sm w-auto">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $cat) <option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach
                    </select>
                    <input type="number" id="bulkPrice" class="form-control form-control-sm w-auto" placeholder="Giá chung...">
                    <input type="number" id="bulkQty" class="form-control form-control-sm w-auto" placeholder="Kho chung...">
                    <button type="button" class="btn btn-sm btn-dark" onclick="applyToSelected()">Áp dụng</button>
                </div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-dark">
                  <tr>
                    <th style="width: 40px;"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                    <th style="width: 150px;">Hình ảnh</th>
                    <th>Tên SP (Bỏ trống nếu không lưu)</th>
                    <th style="width: 180px;">Danh mục</th>
                    <th style="width: 130px;">Giá bán</th>
                    <th style="width: 100px;">Số lượng</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i = 0; $i < 10; $i++)
                  <tr>
                    <td><input class="form-check-input row-checkbox" type="checkbox" value="{{ $i }}"></td>
                    <td><input type="file" name="products[{{ $i }}][img]" class="form-control form-control-sm" accept="image/*"></td>
                    <td><input type="text" name="products[{{ $i }}][name]" class="form-control form-control-sm" placeholder="Nhập tên sản phẩm..."></td>
                    <td>
                      <select name="products[{{ $i }}][catid]" class="form-select form-select-sm cat-select">
                        @foreach($categories as $cat)
                          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="number" name="products[{{ $i }}][price]" class="form-control form-control-sm price-input"></td>
                    <td><input type="number" name="products[{{ $i }}][quantity]" class="form-control form-control-sm qty-input" value="1"></td>
                  </tr>
                  @endfor
                </tbody>
              </table>
            </div>

            <div class="panel-footer p-3 text-end border-top">
                <a href="{{ route('admin.sanpham') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-up"></i> Lưu tất cả SP hợp lệ</button>
            </div>
          </section>
        </form>
        
      </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Nút Tick Tất cả
    $('#selectAll').click(function() {
        $('.row-checkbox').prop('checked', this.checked);
    });

    // Hàm áp dụng giá trị xuống các hàng được tick
    function applyToSelected() {
        let price = $('#bulkPrice').val();
        let qty = $('#bulkQty').val();
        let cat = $('#bulkCat').val();

        $('.row-checkbox:checked').each(function() {
            let tr = $(this).closest('tr');
            if(price !== "") tr.find('.price-input').val(price);
            if(qty !== "") tr.find('.qty-input').val(qty);
            if(cat !== "") tr.find('.cat-select').val(cat);
        });
    }
</script>
@endsection