<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class ProductCategoryItem extends Component
{
    public $row_category;

    public function __construct($rowcategory)
    {
        $this->row_category = $rowcategory;
        
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

        // Lấy danh sách các danh mục con dựa trên row_category
        $category_item = $this->row_category;
        $args1 = [
            ['status', '=', 1],
            ['parent_id', '=', $category_item->id],
        ];

        // Truy vấn danh mục với điều kiện và đếm số lượng sản phẩm liên quan
        $listcategory = Category::where($args1)
            ->whereIn('id', $product->pluck('category_id')) // Lọc theo các danh mục có trong $product
            ->withCount('products') // Đếm số sản phẩm liên quan đến mỗi danh mục
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('components.product-category-item', compact('category_item', 'listcategory'));
    }
}
