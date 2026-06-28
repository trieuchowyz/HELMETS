<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($menu, Request $request)
    {
        $m = Menu::where('slug', $menu)->first();
        $title = $m->name;
        $products = Product
            ::with('menu')
            ->where('catid', $m->catid)
            ->where('parent_id', null)
            ->orderby('id', 'desc')
            ->paginate(9);

        $page = $request->query('page') ?? 1;
        $trangtruoc = $products->previousPageUrl();
        $trangsau = $products->nextPageUrl();

        return view('product.index', compact('products', 'title', 'page', 'trangtruoc', 'trangsau'));
    }

    public function detail($menu, $slug, $id)
    {
        $m = Menu::where('slug', $menu)->first();

        // Nếu không tìm thấy danh mục thì báo lỗi 404 chứ không sập trang
        if (!$m) {
            abort(404, 'Không tìm thấy danh mục');
        }
        $title = $m->name;

        // Dùng findOrFail để nếu ID sản phẩm không có thật thì tự nhảy trang 404
        $product = Product::with('menu')->findOrFail($id);

        return view('product.detail', compact('product', 'title'));
    }
    // App\Http\Controllers\ProductController.php

    public function searchSuggestion(Request $request)
    {
        $keyword = $request->query('keyword');

        // Nếu không nhập gì thì trả về mảng rỗng
        if (empty($keyword)) {
            return response()->json([]);
        }

        // Tìm kiếm sản phẩm theo tên (LIKE %keyword%) dính 1 chữ cũng ra
        // Đồng thời nạp kèm quan hệ 'menu' để lấy slug danh mục dựng URL
        $products = Product::with('menu')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->limit(10) // Giới hạn tối đa 10 kết quả gợi ý nhanh
            ->get();

        // Định dạng lại dữ liệu trả về kèm link chi tiết .html giống cấu trúc route của bạn
        $results = $products->map(function ($product) {
            // Tạo link chuẩn: /{menu}/{slug}-{id}.html
            $menuSlug = $product->menu ? $product->menu->slug : 'san-pham';
            $detailUrl = route('product.detail', [
                'menu' => $menuSlug,
                'slug' => $product->slug,
                'id' => $product->id
            ]);

            return [
                'id' => $product->id,
                'name' => $product->name,
                'img' => asset($product->img),
                'price' => number_format($product->price, 0, ',', '.') . 'đ',
                'url' => $detailUrl
            ];
        });

        return response()->json($results);
    }
}
