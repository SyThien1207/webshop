<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);
      
        $activeCategoryCount = User::where('status', 1)->count();
        $activeCategoryCount1 = User::all()->count();
        $activeCategoryCount2 = User::where('status', 0)->count();

        return view("backend.user.index", compact("list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Lấy danh sách người dùng có status khác 0 và sắp xếp theo ngày tạo mới nhất
    $list = User::where('status', '!=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Định nghĩa các vai trò
    $roles = ['customer', 'admin'];
    $htmlroles = '';

    // Giả sử bạn muốn chọn vai trò của người dùng hiện tại để hiển thị trong dropdown
    $currentUserRole = null;
    
    // Nếu bạn muốn tạo dropdown cho từng người dùng trong danh sách
    foreach ($roles as $role) {
        if ( $role) {
            $htmlroles .= "<option selected value='" . $role . "'>" . $role . "</option>";
        } else {
            $htmlroles .= "<option value='" . $role . "'>" . $role . "</option>";
        }
    }

    return view("backend.user.create", compact("htmlroles"));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->	gender = $request->	gender;
        $user->	phone = $request->	phone;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->address = $request->address;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = $request->updated_at;
        $user->created_by = Auth::id()??1;
        $user->updated_by = $request->updated_by;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = $user->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/user'), $fileName);
                $user->image = $fileName;
            }
        }
        // You may need to add other fields here based on your user model
    
        // Save the updated user
        if ($user->save()) {
            // Redirect the user back to the user index with success message
            return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
        }
    
        // If saving fails, redirect with error message
        return redirect()->route('admin.user.index')->with('error', 'Failed to update user.');
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
        $user=User::find($id);
        $list = User::where('status', '!=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        $roles = ['customer', 'admin'];
        $htmlroles = '';
        
        foreach ($roles as $role) {
            if ($user->roles == $role) {
                $htmlroles .= "<option selected value='" . $role . "'>" . $role . "</option>";
            } else {
                $htmlroles .= "<option value='" . $role . "'>" . $role . "</option>";
            }
        }
        return view("backend.user.edit",compact("user","htmlroles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the user by its ID
        $user = User::find($id);
        
        // If user not found, redirect back with error message
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }
    
        // Update user attributes with new data from the request
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->	gender = $request->	gender;
        $user->	phone = $request->	phone;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->address = $request->address;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = $user->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/user'), $fileName);
                $user->image = $fileName;
            }
        }
        // You may need to add other fields here based on your user model
    
        // Save the updated user
        if ($user->save()) {
            // Redirect the user back to the user index with success message
            return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
        }
    
        // If saving fails, redirect with error message
        return redirect()->route('admin.user.index')->with('error', 'Failed to update user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $user = user::find($id);
        if ($user) {
            $user->status = $user->status == 1 ? 2 : 1;
            $user->save();
        } else {
            $user = new user();
            $user->id = $id; // Ensure the new user has the provided ID
            $user->status = 1; // Default value or another value as needed
            $user->save();
        }


        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.user.index')->with('success', 'user updated successfully.');
    }
    public function destroy(string $id)
    {
        $user = user::find($id);
        if ($user) {
            // Set the user status to 0
            $user->status = 0;
        }
        $user->save();
        // Redirect with success message
        return redirect()->route('admin.user.index')->with('success', 'user updated successfully.');
    }
    public function trash()
    {
        $list = user::where('status', '=', 0)
        ->orderBy('created_at','desc')
        ->get();
      
        
        return view("backend.user.trash", compact("list"));
    }
    public function restore(string $id)
    {
        $user = user::find($id);
        if ($user) {
            // Set the user status to 0
            $user->status = 1;
        }
        $user->save();
        // Redirect with success message
        return redirect()->route('admin.user.trash')->with('success', 'user updated successfully.');
    }
    public function delete(string $id)
    {
        $user = user::find($id);

        // Set the user status to 0
        $user->delete();

        // Redirect with success message
        return redirect()->route('admin.user.trash')->with('success', 'user updated successfully.');
    }
}
