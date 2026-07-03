<div class="modal-dialog">
  <div class="modal-content">
    <form action="{{ route('admin.danhmuc.update', $cat->id) }}" method="POST">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Sửa Danh Mục: {{ $cat->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <div class="mb-3">
          <label class="form-label">Tên danh mục</label>
          <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Danh mục cha</label>
          <select name="parentid" class="form-select">
            <option value="">-- Trở thành danh mục gốc --</option>
            @foreach($parents as $pCat)
              @if($pCat->id != $cat->id)
                <option value="{{ $pCat->id }}" {{ $cat->parentid == $pCat->id ? 'selected' : '' }}>
                  {{ $pCat->name }}
                </option>
              @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>
    </form>
  </div>
</div>