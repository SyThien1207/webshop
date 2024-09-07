<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;
class ProductCardList extends Component
{
   public $product_row = null;
    public function __construct( $productitem)
    {
        $this->product_row = $productitem;
    }
    public function addCart(Request $request)
    {
        $productid = $request->input('productid');
        $qty = $request->input('1');
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
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product=$this->product_row;
        return view('components.product-card-list',compact('product'));
    }
}
