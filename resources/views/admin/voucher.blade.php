@extends('admin.layout.app')

@section('content')

      <div class="container-fluid px-3 px-lg-4 py-4">
        
        <div class="page-heading d-flex justify-content-between align-items-center">
          <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-ticket-perforated" aria-hidden="true"></i></span>
            <div>
              <p class="eyebrow mb-1">Kinh doanh</p>
              <h1 class="h3 mb-1">Mã Ưu Đãi (Vouchers)</h1>
              <p class="text-muted mb-0">Quản lý các chương trình khuyến mãi và giảm giá.</p>
            </div>
          </div>
          <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
              <i class="bi bi-plus-lg"></i> Thêm Voucher mới
            </button>
          </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mt-3">Vui lòng kiểm tra lại thông tin nhập!</div>
        @endif

        <section class="panel mt-4">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Mã Code</th>
                  <th>Mức giảm</th>
                  <th>Giới hạn & SP</th>
                  <th>Số lượng</th>
                  <th>Thời gian</th>
                  <th>Trạng thái</th>
                  <th class="text-end">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach($vouchers as $item)
                <tr>
                  <td class="fw-bold text-primary">{{ $item->code }}</td>
                  <td>
                    @if($item->discount_type == 'fixed')
                        {{ number_format($item->discount_amount, 0, ',', '.') }}đ
                    @else
                        {{ $item->discount_amount }}% 
                        @if($item->max_discount_amount)
                            <br><small class="text-muted">(Tối đa: {{ number_format($item->max_discount_amount, 0, ',', '.') }}đ)</small>
                        @endif
                    @endif
                  </td>
                  <td>
                    <small class="d-block">Đơn tối thiểu: {{ number_format($item->min_order_amount, 0, ',', '.') }}đ</small>
                    @if($item->product_id)
                        <span class="badge text-bg-info mt-1" title="{{ $item->product->name ?? '' }}">SP Cụ thể</span>
                    @else
                        <span class="badge text-bg-secondary mt-1">Toàn sàn</span>
                    @endif
                  </td>
                  <td>{{ $item->quantity }} lượt</td>
                  <td>
                    <small class="d-block">Từ: {{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') : 'Không giới hạn' }}</small>
                    <small class="d-block text-danger">Đến: {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') : 'Không giới hạn' }}</small>
                  </td>
                  <td>
                      @if($item->status == 1)
                          <span class="badge text-bg-success">Hoạt động</span>
                      @else
                          <span class="badge text-bg-secondary">Đã tắt</span>
                      @endif
                  </td>
                  <td class="text-end">
                      <form action="{{ route('admin.voucher.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa mã này?');">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash"></i></button>
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </div>


<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.voucher.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Thêm Mã Ưu Đãi Mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3">
          
          <div class="col-md-6">
            <label class="form-label">Mã Code (Ví dụ: TET2026)</label>
            <input type="text" name="code" class="form-control text-uppercase" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Loại giảm giá</label>
            <select name="discount_type" class="form-select" id="discountType" onchange="toggleMaxDiscount()">
              <option value="fixed">Giảm số tiền cố định (VNĐ)</option>
              <option value="percent">Giảm theo phần trăm (%)</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Mức giảm</label>
            <input type="number" name="discount_amount" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Giảm tối đa (Chỉ áp dụng khi chọn %)</label>
            <input type="number" name="max_discount_amount" id="maxDiscount" class="form-control" placeholder="Để trống nếu không giới hạn" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Đơn tối thiểu áp dụng (VNĐ)</label>
            <input type="number" name="min_order_amount" class="form-control" value="0">
          </div>
          <div class="col-md-6">
            <label class="form-label">Số lượng mã (Lượt dùng)</label>
            <input type="number" name="quantity" class="form-control" value="100" required>
          </div>

          <div class="col-md-12">
            <label class="form-label">Áp dụng cho sản phẩm cụ thể</label>
            <select name="product_id" class="form-select">
              <option value="">-- Áp dụng toàn sàn --</option>
              @foreach($products as $prod)
                <option value="{{ $prod->id }}">{{ $prod->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="datetime-local" name="start_date" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Ngày kết thúc</label>
            <input type="datetime-local" name="end_date" class="form-control">
          </div>

          <div class="col-md-12">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
              <option value="1">Kích hoạt</option>
              <option value="0">Tạm tắt</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Lưu mã ưu đãi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function toggleMaxDiscount() {
        let type = document.getElementById('discountType').value;
        let maxInput = document.getElementById('maxDiscount');
        if(type === 'percent') {
            maxInput.disabled = false;
        } else {
            maxInput.disabled = true;
            maxInput.value = '';
        }
    }
</script>
@endsection