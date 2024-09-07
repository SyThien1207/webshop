<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.profile');
    }
    public function status(string $id)
    {
        $category = Order::find($id);
        if ($category) {
            // Set the category status to 0
            $category->status = 5;
        }
        $category->save();
        // Redirect with success message
        return redirect()->route('profile.index');
    }
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home.index');
        }
    
        // Cập nhật các thông tin khác
        $user->name = $request->name;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
    
        // Kiểm tra nếu có dữ liệu trong ô mật khẩu mới và xác nhận mật khẩu
        if ($request->filled('new_password') || $request->filled('confirm_password')) {
            // Kiểm tra mật khẩu cũ
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu cũ không đúng.']);
            }
    
            // Kiểm tra mật khẩu mới và xác nhận mật khẩu
            if ($request->input('new_password') !== $request->input('confirm_password')) {
                return back()->withErrors(['confirm_password' => 'Mật khẩu xác nhận không khớp.']);
            }
    
            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->input('new_password'));
        }
    
        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = $user->slug . '.' . $request->image->extension();
                $request->image->move(public_path('images/user'), $fileName);
                $user->image = $fileName;
            }
        }
    
        // Lưu các thay đổi
        if ($user->save()) {
            return redirect()->route('profile.index')->with('success', 'Thông tin đã được cập nhật thành công.');
        }
    
        return redirect()->route('profile.index')->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin.');
    }
    
}

