<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo truy vấn cơ bản cho bảng Warehouse và kết hợp với bảng Product và Supplier
        $query = Warehouse::where('warehouses.status', '!=', 0)
                          ->join('products', 'warehouses.product_id', '=', 'products.id')
                          ->leftJoin('suppliers', 'warehouses.supplier_id', '=', 'suppliers.id');
    
        // Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('products.name', 'like', $searchTerm)
                         ->orWhere('suppliers.name', 'like', $searchTerm);
            });
        }
    
        // Sắp xếp theo created_at và phân trang
        $list = $query->orderBy('warehouses.created_at', 'desc')
                      ->select('warehouses.*') // Chọn tất cả các cột từ bảng Warehouse
                      ->paginate(10);
    
        // Đếm số lượng warehouse theo trạng thái
        $activeCategoryCount1 = Warehouse::all()->count();
        $activeCategoryCount2 = Warehouse::where('status', 0)->count();
    
        return view("backend.Warehouse.index", compact("list", "activeCategoryCount1", "activeCategoryCount2"));
    }
    // app/Http/Controllers/WarehouseController.php

public function details($id)
{
        $warehouse = Warehouse::find ( $id );
    if (!$warehouse) {
        return response()->json(['error' => 'Warehouse not found'], 404);
    }

    return view('backend.warehouse.details', compact('warehouse'));
}

    public function create()
    {
        $list = Product::where('status', '!=', '0')
            ->get();
        $html_product_id = "";
        foreach ($list as $item) {
            $html_product_id .= "<option value='" . $item->id . "'" . (($item->id == old('product_id')) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        $list = Supplier::all();

        $html_supplier_id = "";
        foreach ($list as $item) {
            $html_supplier_id .= "<option value='" . $item->id . "'" . (($item->id == old('supplier_id')) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        return view("backend.warehouse.create", compact("html_product_id", "html_supplier_id"));
    }
    public function getProducts()
    {
        $products = Product::select('id', 'name as label')
            ->where('status', '!=', '0')
            ->get();

        return response()->json($products);
    }
    public function store(Request $request)
    {
        $warehouse = new Warehouse();

      
        $warehouse->price = $request->price;

        $warehouse->qty =  $request->qty;
        $warehouse->entry_date =  $request->entry_date;
        $warehouse->product_id = $request->product_id;
        $warehouse->supplier_id = $request->supplier_id;
        $warehouse->created_at = date('Y-m-d H:i:s');
        $warehouse->created_by = Auth::id() ?? 1;
        $warehouse->status = $request->status;

        if ($warehouse->save()) {
            // Chuyển hướng người dùng về trang danh sách category với thông báo thành công

            return redirect()->route('admin.warehouse.index')->with('success', 'Category updated successfully.');
        }

      
    }
    public function edit(string $id)
    {
        $warehouse = Warehouse::find($id);
        $list = Warehouse::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $list = Product::where('status', '!=', '0')
            ->get();
        $html_product_id = "";

        foreach ($list as $item) {
            if ($warehouse->product_id == $item->id) {
                $html_product_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_product_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        $list = Supplier::all();
        $html_supplier_id = "";

        foreach ($list as $item) {
            if ($warehouse->supplier_id == $item->id) {
                $html_supplier_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_supplier_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.warehouse.edit", compact("warehouse", "html_product_id", "html_supplier_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the warehouse by its ID
        $warehouse = Warehouse::findOrFail($id);
    
        $warehouse->entry_date = $request->entry_date;
        $warehouse->qty = $request->qty;
        $warehouse->product_id = $request->product_id;
        $warehouse->supplier_id = $request->supplier_id;
        $warehouse->status = $request->status;
        $warehouse->updated_at = now();
        $warehouse->updated_by = Auth::id() ?? 1;
        $warehouse->save();
    
        return redirect()->route('admin.warehouse.index')->with('success', 'Updated product successfully.');
    }
    
    public function dowProducts(Request $request, string $id)
    {
        // Tìm warehouse bằng ID
        $warehouse = Warehouse::findOrFail($id);
    
        // Lấy product_id từ warehouse
        $product_id = $warehouse->product_id;
    
        // Tìm sản phẩm bằng product_id
        $product = Product::findOrFail($product_id);
    
        // Lấy số lượng từ request và cộng vào số lượng hiện tại của sản phẩm
        $warehouseQty = $request->input('qty');
        $product->qty += $warehouseQty;
    
        // Cập nhật status thành 1 (đã nhập kho)
        $warehouse->status = 1;
        $warehouse->save();
    
        if ($product->save()) {
            return redirect()->route('admin.warehouse.index')->with('success', 'Cập nhật số lượng sản phẩm thành công.');
        }
    
        return redirect()->route('admin.warehouse.index')->with('error', 'Không thể cập nhật số lượng sản phẩm.');
    }
    public function destroy(string $id)
    {
        $product = Warehouse::find($id);
        if ($product) {
            // Set the product status to 0
            $product->status = 0;
        }
        $product->save();
        // Redirect with success message
        return redirect()->route('admin.warehouse.index')->with('success', 'product updated successfully.');
    }
    public function trash(Request $request)
    {
        // Khởi tạo truy vấn cơ bản cho bảng Warehouse và kết hợp với bảng Product và Supplier
        $query = Warehouse::where('warehouses.status', '=', 0)
                          ->join('products', 'warehouses.product_id', '=', 'products.id')
                          ->leftJoin('suppliers', 'warehouses.supplier_id', '=', 'suppliers.id');
    
        // Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('products.name', 'like', $searchTerm)
                         ->orWhere('suppliers.name', 'like', $searchTerm);
            });
        }

        $list = $query->orderBy('warehouses.created_at', 'desc')
                      ->select('warehouses.*') 
                      ->paginate(10);
        return view("backend.Warehouse.trash", compact("list", ));
    }
    public function restore(string $id)
    {
        $product = Warehouse::find($id);
        if ($product) {
            // Set the product status to 0
            $product->status = 1;
        }
        $product->save();
        // Redirect with success message
        return redirect()->route('admin.warehouse.trash')->with('success', 'product updated successfully.');
    }
    public function delete(string $id)
    {
        $product = Warehouse::findOrFail($id);
    
        // Xóa các hình ảnh mô tả
        foreach ($product->productimags as $productimage) {
            if (file_exists(public_path('images/product/Product_imag/' . $productimage->images))) {
                unlink(public_path('images/product/Product_imag/' . $productimage->images));
            }
            $productimage->delete();
        }
    
        // Xóa hình đại diện nếu có
        if ($product->image && file_exists(public_path('images/product/' . $product->image))) {
            unlink(public_path('images/product/' . $product->image));
        }
    
        // Xóa sản phẩm
        $product->delete();
    
        // Redirect with success message
        return redirect()->route('admin.product.trash')->with('success', 'Product deleted successfully.');
    }
    
    
}
