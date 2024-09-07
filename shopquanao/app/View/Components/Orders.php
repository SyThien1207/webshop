<?php
namespace App\View\Components;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class Orders extends Component
{
    public $cartItems;

    /**
     * Tạo một instance mới của component.
     */
    public function __construct()
    {
        // Lấy các mục giỏ hàng cho người dùng đã xác thực
        $this->cartItems = Order::where('user_id', auth()->id())->with('orderDetails.product')->get();
    }


    /**
     * Lấy nội dung của view đại diện cho component.
     */
    public function render(): View|Closure|string
    {
        return view('components.orders', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
