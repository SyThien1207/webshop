<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Categories extends Component
{
    /**
     * Create a new component instance.z
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
        $product = Product::select('category_id', DB::raw('COUNT(*) as amount'))
        ->groupBy('category_id')
        ->orderBy('amount', 'desc')
        ->take(10)
        ->get();
    
    $category = Category::whereIn('id', $product->pluck('category_id'))
        ->withCount('products') // 'products' là mối quan hệ trong model Category mà đếm số sản phẩm
        ->get();
    
        return view('components.categories',compact('category'));
    }
}
