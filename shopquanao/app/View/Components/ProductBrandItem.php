<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class ProductBrandItem extends Component
{
    public $row_brand;
    public function __construct( $rowbrand)
    {
        $this->row_brand = $rowbrand;    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = Product::select('brand_id', DB::raw('COUNT(*) as amount'))
        ->groupBy('brand_id')
        ->orderBy('amount', 'desc')
        ->take(10)
        ->get();
        $brand_item = $this->row_brand;
        $args1 = [
            ['status', '=', 1],
        ];
        $listbrand = Brand::where($args1)
        ->whereIn('id', $product->pluck('brand_id')) // Lọc theo các danh mục có trong $product
        ->withCount('products') 
        ->orderBy('sort_order', 'asc')->get();
        return view('components.product-brand-item', compact('brand_item', 'listbrand'));
    }
}
