<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardDrop extends Component
{
    public $list_cart;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Lấy dữ liệu giỏ hàng từ session
        $this->list_cart = session('carts', []);
    }

    /**
     * Hàm xóa sản phẩm khỏi giỏ hàng
     */


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $list_cart = session('carts', []);
        return view('components.card-drop',compact('list_cart'));
    }
}
