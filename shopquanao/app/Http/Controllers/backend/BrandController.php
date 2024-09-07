<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    public function index(Request $request)
    {
      
        $query = Brand::where('status','!=',0);
       
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Brand::where('status', 1)->count();
        $activeCategoryCount1 = Brand::all()->count();
        $activeCategoryCount2 = Brand::where('status', 0)->count();
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau: " . $item->name . "</option>";
        }
        return view("backend.brand.index",compact("list","htmlsortorder", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }
    public function product($slug) {
        $brand = Brand::where('slug', $slug)->where('status', 1)->first();
    
        if (!$brand) {
            // Xử lý trường hợp không tìm thấy danh mục
            return redirect()->back()->with('error', 'brand không tồn tại.');
        }
    
        $productQuery = Product::where('status', 1)->where('brand_id', $brand->id);
        
      
    
        $products = $productQuery->paginate(16);
    
        return view("backend.brand.view", compact("products", "brand", ));
    }
    
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        //$brand->image = $request->name;
        $brand->sort_order = $request->sort_order;
        $brand->description = $request->description;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->updated_at = $request->updated_at;
        $brand->created_by = Auth::id()??1;
        $brand->updated_by = $request->updated_by;
        $brand->status = $request->status;
        if($request->image){
            if(in_array($request->image->extension(),["jpg", "png", "gif", "webp"])){
                $fileName=$brand->slug. '.'. $request->image->extension();
                $request->image->move(public_path('images/brand'), $fileName);
                $brand->image=$fileName;
            }
        }
        if ($brand->save()) {
            // Chuyển hướng người dùng về trang danh sách brand với thông báo thành công

            return redirect ()->route( 'admin.brand.index' )->with('success', 'Thêm thương hiệu thành công.');
        }
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.brand.index')->with('error', 'Failed to update brand.');

    }
    public function edit(string $id)
    {
        $brand=brand::find($id);
        $list = brand::where('status', '!=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
          
            if ($brand->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            }
            
          
        }
                return view("backend.brand.edit",compact("brand","htmlsortorder"));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('admin.brand.index')->with('error', 'Brand not found');
        }

        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        $brand->sort_order = $request->sort_order;
        $brand->description = $request->description;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->status = $request->status;

        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                // Remove the old image if exists
                if ($brand->image && file_exists(public_path('images/brand/' . $brand->image))) {
                    unlink(public_path('images/brand/' . $brand->image));
                }

                // Upload the new image
                $fileName = $brand->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/brand'), $fileName);
                $brand->image = $fileName;
            }
        }

        if ($brand->save()) {
            // Chuyển hướng người dùng về trang danh sách brand với thông báo thành công
            
            return redirect()->route('admin.brand.index')->with('success', 'Cập nhật thương hiệu thành công.');
        }
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.brand.index')->with('error', 'Failed to update brand.');
    }

    public function destroy(string $id)
    {
        $banner = Brand::find($id);
        if ($banner) {
            // Set the banner status to 0
            $banner->status = 0;
    
        }
            $banner->save();
            return redirect()->route('admin.brand.index')->with('success', 'Thêm thương hiệu vào thùng rác thành công.');

    }
    public function trash(){
        $list = Brand::where('status', '=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        return view("backend.brand.trash",compact("list"));
    }
    public function restore(string $id)
    {
        $banner = Brand::find($id);
        if ($banner) {
            // Set the banner status to 0
            $banner->status = 1;
    
        }
            $banner->save();
        // Redirect with success message
        return redirect()->route('admin.brand.trash')->with('success', 'Khôi phục thương hiệu thành công.');
       }
       public function delete(string $id)
       {
           $banner = Brand::find($id);
           
               // Set the banner status to 0
               $banner->delete();
       
           // Redirect with success message
           return redirect()->route('admin.brand.trash')->with('success', 'Xóa thương hiệu thành công.');
        }
    public function status(string $id){
        $brand = Brand::find($id);
        if($brand){
            $brand->status = $brand->status == 1 ? 2 : 1;
            $brand->save();
        } else {
            $brand = new Brand();
            $brand->id = $id;
            $brand->status = 1; 
            $brand->save();
        }
        return redirect()->route('admin.brand.index')->with('success', 'Thay đổi trạng thái thành công.');
    }

}
