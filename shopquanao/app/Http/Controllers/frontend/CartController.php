<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $list_cart = session('carts', []);
        $coupon = session('coupon', []);
        return view('frontend.cart', compact('list_cart','coupon'));
    }

    public function addCart(Request $request)
    {
        $productid = $request->input('productid');
        $qty = $request->input('qty');
        $product = Product::find($productid);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tìm thấy'], 404);
        }

        $cartitem = [
            'id' => $productid,
            'image' => $product->image,
            'name' => $product->name,
            'qty' => $qty,
            'price' => ($product->pricesale > 0) ? $product->pricesale : $product->price,
        ];

        $carts = session('carts', []);

        $found = false;
        foreach ($carts as &$cart) {
            if ($cart['id'] == $productid) {
                $cart['qty'] += $qty;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $carts[] = $cartitem;
        }

        session(['carts' => $carts]);

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công']);
    }
    public function update(Request $request)
    {
        $carts = session('carts', []);
        $list_qty = $request->qty;
        foreach ($carts as $key => $cart) {
            foreach ($list_qty as $productid => $qtyvalue) {
                if ($carts[$key]['id'] == $productid) {
                    $carts[$key]['qty'] = $qtyvalue;
                }
            }
        }

        session(['carts' => $carts]);
        return redirect()->route('cart.index');
    }
    public function detele($id)
    {
        $carts = session('carts', []);
        foreach ($carts as $key => $cart) {
            if ($carts[$key]['id'] == $id) {
                unset($carts[$key]);
            }
        }

        session(['carts' => $carts]);
        return redirect()->route('cart.index');
    }
    public function detele2($id)
    {
        $carts = session('carts', []);
        foreach ($carts as $key => $cart) {
            if ($carts[$key]['id'] == $id) {
                unset($carts[$key]);
            }
        }

        session(['carts' => $carts]);
        return redirect()->route('home.index');
    }
    public function checkout()
    {
        $list_cart = session('carts', []);
        return view('frontend.checkout', compact('list_cart'));
    }
    public function docheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('website.getlogin')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }
    
        $user = Auth::user();
        $carts = session('carts', []);
    
        if (count($carts) > 0) {
            try {
                $user->phone = $request->input('phone');
                $user->address = $request->input('address');
                
                $user->save();
            } catch (\Exception $e) {
                return redirect()->route('cart.index')->with('error', 'Đã có lỗi xảy ra khi cập nhật thông tin người dùng: ' . $e->getMessage());
            }
            try {
                // Tạo đơn hàng mới
                $order = new Order();
                $order->user_id = $user->id;
                $order->address = $request->input('address');
                $order->note = $request->input('note') ? $request->note : null;
                $order->created_at = now();
                $order->status = 4;
    
                // Khởi tạo biến để tính tổng tiền và số tiền giảm giá
                $totalMoney = 0;
                $totalDiscount = 0;
    
                // Tính tổng giá trị của giỏ hàng
                foreach ($carts as $cart) {
                    $totalMoney += $cart['price'] * $cart['qty'];
                }
    
                // Áp dụng giảm giá nếu có mã giảm giá
                if (Session::get('coupon')) {
                    foreach (Session::get('coupon') as $key => $cou) {
                        if ($cou['coupon_condition'] == 1) { // Giảm giá theo phần trăm
                            $totalDiscount = ($totalMoney * $cou['coupon_number']) / 100;
                        } elseif ($cou['coupon_condition'] == 2) { // Giảm giá số tiền cố định
                            $totalDiscount = $cou['coupon_number'];
                        }
                        $coupon = Coupon::find($cou['id']);
                        if ($coupon) {
                            $coupon->coupon_time = max($coupon->coupon_time - 1, 0);
                            $coupon->save();
                        }
                    }
                }
    
                // Tính tổng tiền cuối cùng sau khi giảm giá
                $finalAmount = $totalMoney - $totalDiscount;
    
                if ($order->save()) {
                    foreach ($carts as $cart) {
                        $orderdetail = new Orderdetail();
                        $orderdetail->order_id = $order->id;
                        $orderdetail->product_id = $cart['id'];
                        $orderdetail->price = $cart['price'];
                        $orderdetail->qty = $cart['qty'];
                        
                        // Lưu số tiền giảm giá cho từng sản phẩm
                        $orderdetail->discount = $totalDiscount;
                        
                        // Tính số tiền sau khi áp dụng giảm giá cho mỗi sản phẩm
                        $orderdetail->amount = $cart['price'] * $cart['qty'] - ($totalDiscount / count($carts));
                        
                        $orderdetail->created_at = now();
                        $orderdetail->save();
                    }
    
                    // Xóa giỏ hàng sau khi đặt hàng thành công
                    session(['carts' => []]);
                    session(['coupon' => []]);
    
                    return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công');
                } else {
                    return redirect()->route('cart.index')->with('error', 'Đã có lỗi xảy ra khi đặt hàng');
                }
            } catch (\Exception $e) {
                return redirect()->route('cart.index')->with('error', 'Đã có lỗi xảy ra khi tạo đơn hàng: ' . $e->getMessage());
            }
        }
    
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
    }
    
    public function applyCoupon(Request $request){
        // Lấy tất cả dữ liệu từ yêu cầu của người dùng
        $data = $request->all();
    
        // Tìm mã giảm giá trong cơ sở dữ liệu dựa trên mã mà người dùng đã nhập
        $coupon = Coupon::where([['coupon_code', $data['coupon']],['coupon_time','>',0]])->first();
    
        // Kiểm tra xem mã giảm giá có tồn tại không
        if ($coupon) {
            // Đếm số lượng mã giảm giá tìm thấy (nếu có)
            $count_coupon = $coupon->count();
    
            // Nếu có ít nhất một mã giảm giá hợp lệ
            if ($count_coupon > 0) {
                // Lấy dữ liệu session hiện tại để kiểm tra xem đã có mã giảm giá trong session chưa
                $coupon_session = Session::get('coupon');
    
                // Kiểm tra xem session hiện tại có mã giảm giá hay không
                if ($coupon_session == true) {
                    // Đặt biến kiểm tra để xác định có thể thêm mã giảm giá hay không
                    $is_available = 0;
    
                    // Nếu mã giảm giá có thể được thêm vào (is_available == 0)
                    if ($is_available == 0) {
                        // Tạo mảng chứa thông tin mã giảm giá
                        $cou[] = array(
                            'id'=>$coupon->id,
                            'coupon_code' => $coupon->coupon_code, // Mã giảm giá
                            'coupon_condition' => $coupon->coupon_condition, // Điều kiện giảm giá (ví dụ: giảm phần trăm hoặc giảm số tiền cố định)
                            'coupon_number' => $coupon->coupon_number, // Số lượng giảm giá (ví dụ: 10% hoặc 100k)
                        );
                        // Lưu mảng chứa mã giảm giá vào session
                         Session::put('coupon', $cou);
                    }
                } else { // Nếu không có mã giảm giá nào trong session
                    // Tạo session mới với mã giảm giá
                    $cou[] = array(
                        'id'=>$coupon->id,
                        'coupon_code' => $coupon->coupon_code, // Mã giảm giá
                        'coupon_condition' => $coupon->coupon_condition, // Điều kiện giảm giá
                        'coupon_number' => $coupon->coupon_number, // Số lượng giảm giá
                    );
                    // Lưu mảng chứa mã giảm giá vào session
                    Session::put('coupon', $cou);
                }
    
                // Lưu session lại
                Session::save();
    
                // Quay lại trang trước và gửi kèm thông báo "Thêm mã giảm giá thành công"
                return redirect()->back()->with('success', 'Thêm mã giảm giá thành công');
            }
        } else { // Nếu không tìm thấy mã giảm giá trong cơ sở dữ liệu
            // Quay lại trang trước và gửi kèm thông báo lỗi "Mã giảm giá không đúng"
            return redirect()->back()->with('error', 'Mã giảm giá không đúng');
        }
    }
    
    
}
