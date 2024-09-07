<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getlogin()
    {
        return view("frontend.login");
    }
    public function register()
    {
        return view("frontend.register");
    }
    public function dologin(Request $request)
    {
        $credentials = [
            'password' => $request->password,
            'status'   => 1
        ];
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials["email"] = $request->username;
        } else {
            $credentials["username"] = $request->username;
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index');
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }

    public function signup(Request $request)

    {
        $user = new User();
        $user->name = $request->username;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->gender = Null;
        $user->phone = Null;
        $user->email = $request->email;
        $user->roles = 'customer';
        $user->status = 1;
        $user->address = Null;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = Auth::id() ?? 1;
        $user->image = Null;

        // Lưu người dùng mới
        if ($user->save()) {
            // Đặt trường created_by thành ID của người dùng mới
            $user->created_by = $user->id;
            $user->save();

            // Chuyển hướng người dùng trở lại trang danh sách người dùng với thông báo thành công
            return redirect()->route('website.getlogin')->with('success', 'Tạo tài khoản thành công.');
        }

        // Nếu lưu thất bại, chuyển hướng với thông báo lỗi
        return redirect()->route('website.getlogin')->with('warning', 'vui lòng nhập đủ thông tin!!.');
    }
}
