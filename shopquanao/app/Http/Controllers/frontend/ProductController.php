<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Khởi tạo truy vấn cơ bản cho sản phẩm
        $productQuery = Product::where([['status', 1],['qty', '>', '0']]);
    
     
    
        // Kiểm tra từ khóa tìm kiếm
        if ($key = request()->key) {
            $productQuery->where('name', 'like', '%' . $key . '%');
        }
    
        // Kiểm tra và áp dụng lọc theo khoảng giá
        if ($minPriceSale = request()->min_pricesale) {
            $productQuery->where('price', '>=', $minPriceSale);
        } elseif ($minPrice = request()->min_price) {
            $productQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice = request()->max_price) {
            $productQuery->where('price', '<=', $maxPrice);
        }
    
        // Kiểm tra và áp dụng sắp xếp
        if ($sort = request()->sort) {
            switch ($sort) {
                case 'price_asc':
                    $productQuery->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $productQuery->orderBy('price', 'desc');
                    break;
                case 'default':
                    $productQuery->orderBy('created_at', 'desc');
                    break;
                default:
                    $productQuery->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $productQuery->orderBy('created_at', 'desc');
        }
    
        // Thực hiện phân trang
        $product = $productQuery->paginate(12);
    
        // Lấy chế độ hiển thị
        $viewMode = request()->view_mode ?? 'grid';
    
        // Trả về view với dữ liệu sản phẩm và chế độ hiển thị
        return view("frontend.allproduct", compact('product', 'viewMode'));
    }
    public function index2()
    {
        // Khởi tạo truy vấn cơ bản cho sản phẩm
        $productQuery = Product::where([['status', 1],['qty', '>', '0']]);
    
     
    
        // Kiểm tra từ khóa tìm kiếm
        if ($key = request()->key) {
            $productQuery->where('name', 'like', '%' . $key . '%');
        }
    
        // Kiểm tra và áp dụng lọc theo khoảng giá
        if ($minPriceSale = request()->min_pricesale) {
            $productQuery->where('price', '>=', $minPriceSale);
        } elseif ($minPrice = request()->min_price) {
            $productQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice = request()->max_price) {
            $productQuery->where('price', '<=', $maxPrice);
        }
    
        // Kiểm tra và áp dụng sắp xếp
        if ($sort = request()->sort) {
            switch ($sort) {
                case 'price_asc':
                    $productQuery->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $productQuery->orderBy('price', 'desc');
                    break;
                case 'default':
                    $productQuery->orderBy('created_at', 'desc');
                    break;
                default:
                    $productQuery->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $productQuery->orderBy('created_at', 'desc');
        }
    
        // Thực hiện phân trang
        $product = $productQuery->paginate(8);
    
        // Lấy chế độ hiển thị
        $viewMode = request()->view_mode ?? 'grid';
    
        // Trả về view với dữ liệu sản phẩm và chế độ hiển thị
        return view("frontend.productlist", compact('product', 'viewMode'));
    }
    public function search()
    {
        $query = request()->q;
        $type = request()->type;
        $selectedCategory = request()->cat;
    
        // Khởi tạo kết quả rỗng cho sản phẩm và bài viết
        $products = collect();
        $posts = collect();
    
        if ($type == 'all' || $type == 'product') {
            $productQuery = Product::where([['status', 1],['qty', '>', '0']]);
    
            if ($query) {
                $productQuery->where('name', 'like', '%' . $query . '%');
            }
    
            if ($selectedCategory) {
                $productQuery->where('category_id', $selectedCategory);
            }
    
            $products = $productQuery->paginate(16);
        }
    
        if ($type == 'all' || $type == 'post') {
            $postQuery = Post::where('status', 1);
    
            if ($query) {
                $postQuery->where('title', 'like', '%' . $query . '%');
            }
    
            $posts = $postQuery->paginate(16);
        }
    
        return view('frontend.search', compact('products', 'posts', 'type'));
    }
    
    
    public function product($slug) {
        $brand = Brand::where('slug', $slug)->where('status', 1)->first();
        $category = Category::where('slug', $slug)->where('status', 1)->first();
        
        $productQuery = Product::where([['status', 1],['qty', '>', '0']]);
    
        if ($brand) {
            $productQuery->where('brand_id', $brand->id);
        } elseif ($category) {
            $productQuery->where('category_id', $category->id);
        } else {
            // Xử lý trường hợp không tìm thấy brand hoặc category
            return redirect()->back()->with('error', 'Brand hoặc Category không tồn tại.');
        }
    
        if ($key = request()->key) {
            $productQuery->where('name', 'like', '%' . $key . '%');
        }
    
        // Kiểm tra và áp dụng lọc theo khoảng giá
        if ($minPrice = request()->min_price) {
            $productQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice = request()->max_price) {
            $productQuery->where('price', '<=', $maxPrice);
        }
    
        // Kiểm tra và áp dụng sắp xếp
        if ($sort = request()->sort) {
            switch ($sort) {
                case 'price_asc':
                    $productQuery->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $productQuery->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $productQuery->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $productQuery->orderBy('name', 'desc');
                    break;
                default:
                    $productQuery->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $productQuery->orderBy('created_at', 'desc');
        }
    
        $product = $productQuery->paginate(12);
        $viewMode = request()->view_mode ?? 'list';
        if ($brand) {
            return view("frontend.product-brand", compact("product", "brand","viewMode"));
        } elseif ($category) {
            return view("frontend.product-category", compact("product", "category","viewMode"));
        }
    }
    
    
    public function product_detail(string $id)
    {
        $product=Product::find($id);
        $list = Product::orderBy('created_at', 'desc')
        ->get();
        
        $product_list= Product::where([['id','!=',$product->id],['status' ,'=', 1]])
        ->where('category_id','=', $product->category_id)
        ->orderBy('created_at')
        ->limit(4)
        ->get();
        return view("frontend.product-detail",compact("product","product_list"));
    }
    public function quick_view(string $id)
    {
        $product=Product::find($id);
        $list = Product::where('status', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();
        
   
        return view ( 'frontend.quick-view',compact("product") );
    }
   
}
