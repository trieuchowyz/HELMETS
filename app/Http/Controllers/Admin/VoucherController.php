<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Product;

class VoucherController extends Controller
{
    // Hiển thị danh sách
    public function index() {
        $vouchers = Voucher::with('product')->orderBy('id', 'desc')->get();
        // Lấy danh sách sản phẩm để đưa vào thẻ <select> khi tạo voucher
        $products = Product::where('status', 1)->select('id', 'name')->get(); 
        
        return view('admin.voucher', compact('vouchers', 'products'));
    }

    // Thêm mới Voucher
    public function store(Request $request) {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'discount_amount' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
        ]);

        Voucher::create($request->all());
        return redirect()->back()->with('success', 'Thêm mã giảm giá thành công!');
    }

    // Cập nhật Voucher
    public function update(Request $request, $id) {
        $voucher = Voucher::findOrFail($id);
        
        $request->validate([
            'code' => 'required|unique:vouchers,code,'.$id,
            'discount_amount' => 'required|numeric|min:1',
        ]);

        $voucher->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    // Xóa Voucher
    public function destroy($id) {
        Voucher::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
    }
}