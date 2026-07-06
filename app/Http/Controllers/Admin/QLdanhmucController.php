<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache; // Gọi thêm thư viện Cache

class QLdanhmucController extends Controller
{
    public function index() {
        $categories = Category::whereNull('parentid')->with('children')->orderBy('id', 'desc')->get();
        $parentCategories = Category::whereNull('parentid')->where('status', 1)->get();
        return view('admin.QLdanhmuc', compact('categories', 'parentCategories'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|max:255']);

        $category = Category::create([
            'name' => $request->name,
            'parentid' => $request->parentid ?: null,
            'status' => 1
        ]);

        $parentMenuId = $request->parentid ? Menu::where('catid', $request->parentid)->value('id') : null;

        Menu::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'catid' => $category->id,
            'parentid' => $parentMenuId,
            'display' => 1,
            'stt' => 0
        ]);

        Cache::flush(); // Quét sạch Cache sau khi thêm
        return redirect()->back()->with('success', 'Thêm danh mục thành công!');
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required|max:255']);

        if ($request->parentid == $id) {
            return redirect()->back()->with('error', 'Một danh mục không thể tự làm cha của chính nó!');
        }

        $category->update([
            'name' => $request->name,
            'parentid' => $request->parentid ?: null,
        ]);

        $parentMenuId = $request->parentid ? Menu::where('catid', $request->parentid)->value('id') : null;

        // Dùng updateOrCreate: Tìm Menu có catid tương ứng, nếu không có thì tự đẻ ra luôn
        Menu::updateOrCreate(
            ['catid' => $category->id],
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parentid' => $parentMenuId
            ]
        );

        Cache::flush(); // Quét sạch Cache sau khi sửa
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công!');
    }

    public function toggleStatus($id) {
        $category = Category::findOrFail($id);

        if ($category->status == 1) {
            $activeChildrenCount = Category::where('parentid', $id)->where('status', 1)->count();
            if ($activeChildrenCount > 0) {
                return redirect()->back()->with('error', 'Không thể tắt! Danh mục này đang chứa danh mục con.');
            }
            $category->status = 0;
            $msg = 'Đã tắt danh mục!';
        } else {
            $category->status = 1;
            $msg = 'Đã bật lại danh mục!';
        }
        $category->save();

        // Đồng bộ trạng thái Ẩn/Hiện của Menu
        Menu::where('catid', $category->id)->update(['display' => $category->status]);

        Cache::flush(); // Quét sạch Cache
        return redirect()->back()->with('success', $msg);
    }
}