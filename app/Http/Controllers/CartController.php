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
                $cart->quantity = $request->quantity;
                $cart->total = $cart->quantity * $cart->price;
                $cart->save();

                // Tính lại tổng tiền của toàn bộ giỏ hàng
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
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 201);
        }
        $cart = Cart::where('user_id', $user_id)->where('product_id', $pid)->first();
        if($cart){
            //Tăng số lượng sp trong giỏ hàng
            $cart->quantity = $cart->quantity + $q;
            $cart->total = $cart->quantity * $cart->price;
            $cart->save();
            return response()->json(['message' => "Đã thêm sản phẩm $product->name vào giỏ hàng"], 201);
        }
        else {
            $quantity = $q;
            $price = $product->price;
            $total = $quantity * $price;

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $pid,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $total
            ]);
            return response()->json(['message' => "Đã thêm sản phẩm $product->name vào giỏ hàng"], 201);
            
        }
    }

    public function updatecart(Request $request) {
        try{
            //để cập nhật sl thì cần id của giỏ hàng
            $id = $request->id;//mảng id giỏ hàng
            $quantity = $request->quantity;//mảng số lượng
            for($i = 0; $i < sizeof($id); $i++){
                $cart = Cart::find($id[$i]);
                if($cart){
                    $cart->quantity = $quantity[$i];
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
    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
        ]);

        $userId = Auth::id();
        $carts =Cart::where('user_id', $userId)->get();
        
        if ($carts->isEmpty()) return back();

        // 1. Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $carts->sum('total'),
            'payment_method' => $request->payment_method ?? 'COD',
            'shipping_address' => $request->shipping_address,
            'status' => 'pending' // Mặc định là chờ xử lý
        ]);

        // 2. Chuyển SP từ Giỏ hàng sang Chi tiết đơn hàng
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price
            ]);
        }

        // 3. Xóa sạch giỏ hàng cũ của user này
        Cart::where('user_id', $userId)->delete();

        // 4. Điều hướng về trang tài khoản để xem tiến độ
        return redirect()->route('account.index')->with('success', 'Đặt hàng thành công! Cửa hàng sẽ sớm liên hệ với bạn.');
    }
}
