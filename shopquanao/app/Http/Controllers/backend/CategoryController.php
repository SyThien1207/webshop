<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = Category::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Category::where('status', 1)->count();
        $activeCategoryCount1 = Category::all()->count();
        $activeCategoryCount2 = Category::where('status', 0)->count();

        $htmlparentid = "";
        $htmlsortorder = "";
        foreach (Category::where('status', '!=', 0)->orderBy('created_at', 'desc')->get() as $item) {
            $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau " . $item->name . "</option>";
        }

        return view("backend.category.index", compact("list", "htmlparentid", "htmlsortorder", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }
    public function product($slug) {
        $category = Category::where('slug', $slug)->where('status', 1)->first();
    
        if (!$category) {
            // Xử lý trường hợp không tìm thấy danh mục
            return redirect()->back()->with('error', 'Category không tồn tại.');
        }
    
        $productQuery = Product::where('status', 1)->where('category_id', $category->id);
        
      
    
        $products = $productQuery->paginate(16);
    
        return view("backend.category.view", compact("products", "category", ));
    }
    

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $request->parent_id ? $request->parent_id : null;
        $category->sort_order = $request->sort_order;
        $category->description = $request->description;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = Auth::id() ?? 1;
        $category->status = $request->status;
        if ($request->image) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/category'), $fileName);
                $category->image = $fileName;
            }
        }

        if ($category->save()) {
            // Chuyển hướng người dùng về trang danh sách category với thông báo thành công

            return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công.');
        }

        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.category.index')->with('error', 'Failed to update category.');
    }
    
    public function edit(string $id)
    {
        $category = Category::find($id);
        $list = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        foreach ($list as $item) {
            $parentCategory = Category::find($item->parent_id);
            $parentName = $parentCategory ? $parentCategory->name : 'Không có';
    
            if ($category->id == $item->id) {
                $htmlparentid .= "<option selected value='" . $item->parent_id . "'>" . $parentName . "</option>";
            } else {
                $htmlparentid .= "<option value='" . $item->parent_id . "'>" . $parentName . "</option>";
            }

            if ($category->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            }
        }
        return view("backend.category.edit", compact("category", "htmlparentid", "htmlsortorder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lấy category từ database
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Category not found.');
        }

        // Cập nhật các thuộc tính của category
        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->description = $request->description;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1;
        $category->status = $request->status;

        // Xử lý việc upload và lưu hình ảnh
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = $category->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/category'), $fileName);
                $category->image = $fileName;
            }
        }

        // Lưu các thay đổi vào database
        if ($category->save()) {
            // Chuyển hướng người dùng về trang danh sách category với thông báo thành công

            return redirect()->route('admin.category.index')->with('success', 'Cập nhật thành công');
        }

        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.category.index')->with('error', 'Failed to update category.');
    }

    public function status(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->status = $category->status == 1 ? 2 : 1;
            $category->save();
        } else {
            $category = new Category();
            $category->id = $id; // Ensure the new category has the provided ID
            $category->status = 1; // Default value or another value as needed
            $category->save();
        }


        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.category.index')->with('success', 'cập nhật thành công.');
    }
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            // Set the category status to 0
            $category->status = 0;
        }
        $category->save();
        // Redirect with success message
        return redirect()->route('admin.category.index')->with('success', 'thêm vào thùng rác thành công');
    }
    public function trash()
    {
        $list = Category::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view("backend.category.trash", compact("list"));
    }
    public function restore(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            // Set the category status to 0
            $category->status = 1;
    
        }
            $category->save();
        // Redirect with success message
        return redirect()->route('admin.category.trash')->with('success', 'Khôi phục thành công.');
       }
}
