<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{

    public function updateCartAjax(Request $request) {
        try {
            $cart = Cart::find($request->id);
            if($cart) {
                $product = Product::find($cart->product_id);
                $req_qty = $request->quantity;

                // KIỂM TRA TỒN KHO
                if($req_qty > $product->quantity) {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Kho chỉ còn ' . $product->quantity . ' sản phẩm!'
                    ]);
                }

                $cart->quantity = $req_qty;
                $cart->total = $cart->quantity * $cart->price;
                $cart->save();

                $total = Cart::where('user_id', Auth::id())->sum('total');

                return response()->json([
                    'success' => true,
                    'item_total' => $cart->total,
                    'cart_total' => $total
                ]);
            }
            return response()->json(['success' => false, 'message' => 'Không tìm thấy giỏ hàng']);
        } catch(Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi hệ thống']);
        }
    }
    public function detelecart(int $id = 0){
        try{
            $cart = Cart::find($id);
            if($cart){
                $cart->delete();
            }
            // Tính lại tổng tiền sau khi xóa
            $total = Cart::where('user_id', Auth::id())->sum('total');

            return response()->json([
                'deleted' => true, 
                'message' => "Đã xóa sản phẩm trong giỏ hàng",
                'cart_total' => $total
            ], 200);
        }
        catch(Exception $e){
            return response()->json(['deleted' => false,'message' => "Lỗi xóa sản phẩm trong giỏ hàng"], 500);
        }
    }


    //danh sách sản phẩm trong giỏ hàng
    public function index(){
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = collect($carts)->sum(function ($i) {
            return $i->total;
        });
        $title = 'Shopping cart';
        return view('home.cart', compact('title', 'carts', 'total'));
    }

    public function addcart(int $pid, int $q = 1){
        $user_id = Auth::id();
        $product = Product::find($pid);
        
        if(!$product){
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }

        $cart = Cart::where('user_id', $user_id)->where('product_id', $pid)->first();
        
        // Tính tổng số lượng nếu khách thêm vào giỏ
        $newQuantity = $cart ? $cart->quantity + $q : $q;

        // KIỂM TRA VỚI TỒN KHO
        if($newQuantity > $product->quantity){
            return response()->json(['message' => 'Rất tiếc, kho chỉ còn ' . $product->quantity . ' sản phẩm!'], 400);
        }

        if($cart){
            // Tăng số lượng sp trong giỏ hàng
            $cart->quantity = $newQuantity;
            $cart->total = $cart->quantity * $cart->price;
            $cart->save();
            return response()->json(['message' => "Đã thêm sản phẩm $product->name vào giỏ hàng"], 201);
        }
        else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $pid,
                'quantity' => $q,
                'price' => $product->price,
                'total' => $q * $product->price
            ]);
            return response()->json(['message' => "Đã thêm sản phẩm $product->name vào giỏ hàng"], 201);
        }
    }

    public function updatecart(Request $request) {
        try{
            $id = $request->id;
            $quantity = $request->quantity;
            for($i = 0; $i < sizeof($id); $i++){
                $cart = Cart::find($id[$i]);
                if($cart){
                    $product = Product::find($cart->product_id);
                    $qty = $quantity[$i];
                    
                    // Nếu nhập lố, tự ép về số lượng tối đa của kho
                    if($qty > $product->quantity) {
                        $qty = $product->quantity;
                    }

                    $cart->quantity = $qty;
                    $cart->total = $cart->quantity * $cart->price;
                    $cart->save();
                }
            }
            return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Lỗi cập nhật giỏ hàng');
        }
    }

    // Giao diện điền thông tin đặt hàng
    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route('home.cart')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        
        $total = $carts->sum('total');
        return view('home.checkout', compact('carts', 'total'));
    }

    // Xử lý lưu đơn hàng vào Database
    // Xử lý lưu đơn hàng vào Database
    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
        ]);

        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->get();
        
        if ($carts->isEmpty()) return back();

        // BƯỚC QUAN TRỌNG: Kiểm tra kho lần cuối trước khi tạo đơn
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            if (!$product || $product->quantity < $cart->quantity) {
                return back()->with('error', 'Sản phẩm "' . ($product->name ?? 'Không rõ') . '" chỉ còn ' . ($product->quantity ?? 0) . ' cái trong kho, vui lòng giảm số lượng!');
            }
        }

        // 1. Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $carts->sum('total'),
            'payment_method' => $request->payment_method ?? 'COD',
            'shipping_address' => $request->shipping_address,
            'status' => 'pending' // Mặc định là chờ xử lý
        ]);

        // 2. Chuyển SP từ Giỏ hàng sang Chi tiết đơn hàng VÀ TRỪ KHO
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price
            ]);

            // TRỪ SỐ LƯỢNG KHO ĐI
            $product = Product::find($cart->product_id);
            if ($product) {
                $product->quantity -= $cart->quantity;
                $product->save();
            }
        }

        // 3. Xóa sạch giỏ hàng cũ của user này
        Cart::where('user_id', $userId)->delete();

        // 4. Điều hướng về trang tài khoản để xem tiến độ
        return redirect()->route('account.index')->with('success', 'Đặt hàng thành công! Cửa hàng sẽ sớm liên hệ với bạn.');
    }
}
