<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class QLdanhmucController extends Controller
{
    // 1. Hiển thị danh sách
    public function index() {
        // Lấy danh mục cha kèm theo các danh mục con của nó
        $categories = Category::whereNull('parentid')->with('children')->orderBy('id', 'desc')->get();
        
        // Lấy danh sách danh mục cha đang hoạt động để đổ vào thẻ <select> lúc thêm/sửa
        $parentCategories = Category::whereNull('parentid')->where('status', 1)->get();
        
        return view('admin.QLdanhmuc', compact('categories', 'parentCategories'));
    }

    // 2. Thêm mới danh mục
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'parentid' => $request->parentid ?: null,
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Thêm danh mục thành công!');
    }

    // 3. Cập nhật tên hoặc đổi cha/con
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Tránh trường hợp tự chọn chính mình làm cha
        if ($request->parentid == $id) {
            return redirect()->back()->with('error', 'Một danh mục không thể tự làm cha của chính nó!');
        }

        $category->update([
            'name' => $request->name,
            'parentid' => $request->parentid ?: null,
        ]);

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công!');
    }

    // 4. Bật/Tắt trạng thái (Thay cho chức năng Xóa)
    public function toggleStatus($id) {
        $category = Category::findOrFail($id);

        if ($category->status == 1) {
            // Nếu muốn TẮT danh mục này, phải kiểm tra xem nó có danh mục con nào đang BẬT không
            $activeChildrenCount = Category::where('parentid', $id)->where('status', 1)->count();
            
            if ($activeChildrenCount > 0) {
                return redirect()->back()->with('error', 'Không thể tắt! Danh mục này đang chứa ' . $activeChildrenCount . ' danh mục con đang hoạt động.');
            }
            
            // Nếu an toàn, tiến hành tắt
            $category->status = 0;
            $msg = 'Đã tắt danh mục!';
        } else {
            // Bật lại bình thường
            $category->status = 1;
            $msg = 'Đã bật lại danh mục!';
        }

        $category->save();
        return redirect()->back()->with('success', $msg);
    }
}
