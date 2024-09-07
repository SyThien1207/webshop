<?php

namespace App\View\Components;

use App\Models\OrderDetail;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ProductBestSale extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $bestSellingProducts = OrderDetail::select('product_id', DB::raw('SUM(qty) as amount'))
    ->groupBy('product_id')
    ->orderBy('amount', 'desc')
    ->take(10)
    ->get();
    $products = Product::where('qty','>','0')->whereIn('id', $bestSellingProducts->pluck('product_id'))->get();

        return view('components.product-best-sale',compact('products','bestSellingProducts'));
    }
}
