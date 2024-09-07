<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Menu::where('status', 1)->count();
        $activeCategoryCount1 = Menu::all()->count();
        $activeCategoryCount2 = Menu::where('status', 0)->count();
        $list_category = Category::where('status','!=',0)
        ->orderBy('created_at','desc')
        ->select("id","name")
        ->get();
        $list_brand = Brand::where('status','!=',0)
        ->orderBy('created_at','desc')
        ->select("id","name")
        ->get(); 
          $list_topic = Topic::where('status','!=',0)
        ->orderBy('created_at','desc')
        ->select("id","name")
        ->get();
        $list_post = Post::where([['status','!=',0],['type','=','page']])
        ->orderBy('created_at','desc')
        ->select("id","title")
        ->get();
      
        $htmlposition = "";
        foreach ($list as $item){
            $htmlposition .= "<option value='" . ($item->position) . "'> " . $item->position . "</option>";
        }
        return view("backend.menu.index",compact("list","list_category","list_topic","list_brand","list_post","htmlposition", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('createCategory')) {
            $listid = $request->categoryid;
            if ($listid) {
                foreach ($listid as $id) {
                    $category = Category::find($id);
                    if ($category != null) {
                        
                        $menu = new Menu();
                        $menu->name = $category->name;
                        $menu->link = 'san-pham/' . $category->slug;
                        $menu->parent_id = $request->parent_id ? $request->parent_id : null;
                        $menu->sort_order = 0;
                        $menu->type = 'category';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = date('Y-m-d H:i:s');
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = $request->status;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
            } else {
                return redirect()->route('admin.menu.index')->with('error', 'Không có danh mục nào được chọn');
            }
        }
    
        if ($request->has('createBrand')) {
            $listid = $request->brandid;
            if ($listid) {
                foreach ($listid as $id) {
                    $brand = Brand::find($id);
                    if ($brand != null) {
                        $menu = new Menu();
                        $menu->name = $brand->name;
                        $menu->link = 'san-pham/' . $brand->slug;
                         $menu->parent_id = $request->parent_id ? $request->parent_id : null;
                        $menu->sort_order = 0;
                        $menu->type = 'brand';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = date('Y-m-d H:i:s');
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = 1;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
            } else {
                return redirect()->route('admin.menu.index')->with('error', 'Không có thuong hieu nào được chọn');
            }
        }
    
        if ($request->has('createPost')) {
            $listid = $request->postid;
            if ($listid) {
                foreach ($listid as $id) {
                    $post = Post::find($id);
                    if ($post != null) {
                        $menu = new Menu();
                        $menu->name = $post->title;
                        $menu->link = 'bai-viet/' . $post->slug;
                         $menu->parent_id = $request->parent_id ? $request->parent_id : null;
                        $menu->sort_order = 0;
                        $menu->type = 'post';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = date('Y-m-d H:i:s');
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = 1;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
            } else {
                return redirect()->route('admin.menu.index')->with('error', 'Không có bai viet nào được chọn');
            }
        }
    
        if ($request->has('createTopic')) {
            $listid = $request->topicid;
            if ($listid) {
                foreach ($listid as $id) {
                    $topic = Topic::find($id);
                    if ($topic != null) {
                        $menu = new Menu();
                        $menu->name = $topic->name;
                        $menu->link = 'trang-don/' . $topic->slug;
                         $menu->parent_id = $request->parent_id ? $request->parent_id : null;
                        $menu->sort_order = 0;
                        $menu->type = 'topic';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = date('Y-m-d H:i:s');
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = 1;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
            } else {
                return redirect()->route('admin.menu.index')->with('error', 'Không có bai viet nào được chọn');
            }
        }
    
        if ($request->has('createCustom')) {
            if ($request->has(['name', 'link'])) {
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = $request->link;
                 $menu->parent_id = $request->parent_id ? $request->parent_id : null;
                $menu->sort_order = 0;
                $menu->type = 'custom';
                $menu->position = $request->position ?? 'mainmenu';
                $menu->table_id = 1;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = Auth::id() ?? 1;
                $menu->status = $request->status;
                $menu->save();
    
                return redirect()->route('admin.menu.index')->with('success', 'Thêm menu thành công');
            } else {
                return redirect()->route('admin.menu.index')->with('error', 'Tên và liên kết không được để trống');
            }
        }
    
        return redirect()->route('admin.menu.index')->with('error', 'Không có hành động nào được chọn');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu=Menu::find($id);
        $list = Menu::where('status', '!=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        $htmlposition = "";

        foreach ($list as $item) {
            $parentMenu = Menu::find($item->parent_id);
            $parentName = $parentMenu ? $parentMenu->name : 'Không có';
    
            if ($menu->id == $item->id) {
                $htmlparentid .= "<option selected value='" . $item->parent_id . "'>" . $parentName . "</option>";
            } else {
                $htmlparentid .= "<option value='" . $item->parent_id . "'>" . $parentName . "</option>";
            }

            if ($menu->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            }
         
          
        }
                return view("backend.menu.edit",compact("menu","htmlparentid","htmlsortorder"));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu not found');
        }

        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order;
        $menu->position = $request->position;
        $menu->updated_at = now();
        $menu->updated_by = Auth::id() ?? 1;
        $menu->status = $request->status;

         // Lưu các thay đổi vào database
         if ($menu->save()) {
            // Chuyển hướng người dùng về trang danh sách menu với thông báo thành công
            
            return redirect()->route('admin.menu.index')->with('success', 'Cập nhật thành công.');
        }
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.menu.index')->with('error', 'Failed to update menu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id){
        $menu = menu::find($id);
        if($menu){
            $menu->status = $menu->status == 1 ? 2 : 1;
            $menu->save();
        } else {
            $menu = new menu();
            $menu->id = $id; // Ensure the new menu has the provided ID
            $menu->status = 1; // Default value or another value as needed
            $menu->save();
        }
     
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.menu.index')->with('success', 'Thay đổi trạng thái thành công.');
     }
     public function destroy(string $id)
     {
         $menu = menu::find($id);
         if ($menu) {
             // Set the menu status to 0
             $menu->status = 0;
     
         }
             $menu->save();
         // Redirect with success message
         return redirect()->route('admin.menu.index')->with('success', 'Thêm vào thùng rác.');
        }
        public function trash(){
            $list = menu::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
            return view("backend.menu.trash",compact("list"));
        }
        public function restore(string $id)
        {
            $menu = menu::find($id);
            if ($menu) {
                // Set the menu status to 0
                $menu->status = 1;
        
            }
                $menu->save();
            // Redirect with success message
            return redirect()->route('admin.menu.trash')->with('success', 'khôi phục thành công.');
           }
           public function delete(string $id)
           {
               $menu = menu::find($id);
               
                   // Set the menu status to 0
                   $menu->delete();
           
               // Redirect with success message
               return redirect()->route('admin.menu.trash')->with('success', 'Xóa thành công.');
              }
         
}
