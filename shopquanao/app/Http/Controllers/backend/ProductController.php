<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productimag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Product::where('status', 1)->count();
        $activeCategoryCount1 = Product::all()->count();
        $activeCategoryCount2 = Product::where('status', 0)->count();

        return view("backend.product.index", compact("list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }
    public function create()
    {
        $list = Category::where('status', '!=', '0')
            ->get();
        $html_category_id = "";
        foreach ($list as $item) {
            $html_category_id .= "<option value='" . $item->id . "'" . (($item->id == old('category_id')) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        $list = Brand::where('status', '!=', '0')
            ->get();
        $html_brand_id = "";
        foreach ($list as $item) {
            $html_brand_id .= "<option value='" . $item->id . "'" . (($item->id == old('brand_id')) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        return view("backend.product.create", compact("html_category_id", "html_brand_id"));
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->title, '-');
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = 0;
      
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->created_at = date('Y-m-d H:i:s');
        $product->created_by = Auth::id() ?? 1;
        $product->status = $request->status;

        if ($request->hasFile('image') && $request->hasFile('image2')) {
            // Xử lý hình ảnh đầu tiên
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName1 = time() . '_' . Str::random(10) . '.' . $request->image->extension();
                $request->image->move(public_path('images/product'), $fileName1);
                $product->image = $fileName1;
            }
        
            // Xử lý hình ảnh thứ hai
            if (in_array($request->image2->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName2 = time() . '_' . Str::random(10) . '.' . $request->image2->extension();
                $request->image2->move(public_path('images/product'), $fileName2);
                $product->image2 = $fileName2;
            }
        }

        if ($product->save()) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        $extension = $image->getClientOriginalExtension();
                        if (in_array($extension, ["jpg", "png", "gif", "webp"])) {
                            $imageName = time() . '_' . Str::random(10) . '.' . $extension;
                            $imagePath = public_path('images/product/Product_imag');

                            // Kiểm tra xem thư mục có tồn tại không, nếu không thì tạo thư mục
                            if (!File::exists($imagePath)) {
                                File::makeDirectory($imagePath, 0755, true);
                            }

                            $image->move($imagePath, $imageName);

                            // Kiểm tra xem việc tạo bản ghi có thành công không
                            Productimag::create([
                                'product_id' => $product->id,
                                'images' => $imageName
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Ghi log lỗi vào file log của Laravel
                        Log::error('Error while uploading images: ' . $e->getMessage());
                        return redirect()->route('admin.product.index')->with('error', 'Lỗi: ' . $e->getMessage());
                    }
                }
            }

            return redirect()->route('admin.product.index')->with('success', 'Thêm sản phẩm thành cồng');
        }
    }
    public function edit(string $id)
    {
        $product = Product::find($id);
        $list = Product::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $list = Category::where('status', '!=', '0')
            ->get();
        $html_category_id = "";

        foreach ($list as $item) {
            if ($product->category_id == $item->id) {
                $html_category_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_category_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        $list = Brand::where('status', '!=', '0')
            ->get();
        $html_brand_id = "";

        foreach ($list as $item) {
            if ($product->brand_id == $item->id) {
                $html_brand_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_brand_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.product.edit", compact("product", "html_category_id", "html_brand_id"));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->title, '-');
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price = $request->price;
    
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->status;
        $product->updated_at = now();
        $product->updated_by = Auth::id() ?? 1;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->image->extension();
            $request->image->move(public_path('images/product'), $fileName);
            $product->image = $fileName;
        }
        if ($request->hasFile('image2')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->image2->extension();
            $request->image2->move(public_path('images/product'), $fileName);
            $product->image2 = $fileName;
        }
        if ($product->save()) {
            if ($request->hasFile('images')) {
                foreach ($product->productimags as $productimage) {
                    if (file_exists(public_path('images/product/Product_imag/' . $productimage->images))) {
                        unlink(public_path('images/product/Product_imag/' . $productimage->images));
                    }
                    $productimage->delete();
                }
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/product/Product_imag'), $imageName);
    
                    Productimag::create([
                        'product_id' => $product->id,
                        'images' => $imageName
                    ]);} }
            return redirect()->route('admin.product.index')->with('success', 'Cập nhật thành công.');
        }
    
        return redirect()->route('admin.product.index')->with('error', 'Cập nhật thất bại.');
    }
    public function status(string $id)
    {
        $product = Product::find($id);
        if ($product->qty >0) {
            $product->status = $product->status == 1 ? 2 : 1;
            $product->save();
        } else {
            echo ( 'sản phẩm đã hết' );
        }
        return redirect()->route('admin.product.index')->with('success', 'Thay đổi trạng thái thành công.');
    }
    public function destroy(string $id)
    {
        $product = product::find($id);
        if ($product) {
            $product->status = 0;
        }
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Thêm vào thùng rác thành công.');
    }
    public function trash()
    {
        $list = Product::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view("backend.product.trash", compact("list"));
    }
    public function restore(string $id)
    {
        $product = product::find($id);
        if ($product) {
            $product->status = 1;
        }
        $product->save();
        return redirect()->route('admin.product.trash')->with('success', 'khôi phục thành công.');
    }
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->productimags as $productimage) {
            if (file_exists(public_path('images/product/Product_imag/' . $productimage->images))) {
                unlink(public_path('images/product/Product_imag/' . $productimage->images));
            }
            $productimage->delete();
        }
        if ($product->image && file_exists(public_path('images/product/' . $product->image))) {
            unlink(public_path('images/product/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin.product.trash')->with('success', 'Xóa thành công.');
    }
    public function sale(Request $request)
    {
        $query = Product::where([['status', '!=', 0],['pricesale','>',0]]);
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $list = $query->orderBy('created_at', 'desc')->paginate(10);
        $activeCategoryCount = Product::where('status', 1)->count();
        $activeCategoryCount1 = Product::all()->count();
        $activeCategoryCount2 = Product::where('status', 0)->count();
    
        $products = Product::all(); // Lấy danh sách tất cả sản phẩm
    
        return view("backend.product.productsale.index", compact("list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2", "products"));
    }
    public function editsale(string $id)
    {
        $product = Product::find($id);
        $list = Product::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $list = Category::where('status', '!=', '0')
            ->get();
        $html_category_id = "";

        foreach ($list as $item) {
            if ($product->category_id == $item->id) {
                $html_category_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_category_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        $list = Brand::where('status', '!=', '0')
            ->get();
        $html_brand_id = "";

        foreach ($list as $item) {
            if ($product->brand_id == $item->id) {
                $html_brand_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_brand_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.product.productsale.edit", compact("product", "html_category_id", "html_brand_id"));
    }
    public function updatesale(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
    
        // Update the product details if provided
        if ($request->filled('product_id')) {
            $product = Product::findOrFail($request->product_id); // Find the selected product by its ID
        }
    
        $product->pricesale = $request->pricesale;
        $product->sale_end_date = $request->sale_end_date;
        // Other fields remain unchanged
        $product->updated_at = now();
        $product->updated_by = Auth::id() ?? 1;
    
        if ($product->save()) {
            return redirect()->route('admin.product.sale')->with('success', 'Cập nhật giảm giá thành công.');
        }
    
        return redirect()->route('admin.product.sale')->with('error', 'Cập nhật thất bại.');
    }
    public function deletesale(string $id)
    {
        $product = Product::find($id);
        $product->pricesale = Null;
        $product->sale_end_date = Null;
        $product->save();
        return redirect()->route('admin.product.sale')->with('success', 'Hủy giảm giá thành công.');
    }
    
}
