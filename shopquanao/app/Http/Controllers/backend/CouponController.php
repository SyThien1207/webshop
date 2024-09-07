<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Coupon::where('status', 1)->count();
        $activeCategoryCount1 = Coupon::all()->count();
        $activeCategoryCount2 = Coupon::where('status', 0)->count();

        return view("backend.Coupon.index", compact("list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $Coupon=new Coupon();
            $Coupon->coupon_name=$request->name; //form
            $Coupon->coupon_time=$request->time; //form
            $Coupon->coupon_condition=$request->condition; //form
            $Coupon->coupon_number=$request->number; //form
            $Coupon->coupon_code=$request->code; //form
            $Coupon->created_at=date('Y-m-d H:i:s');
            $Coupon->status=$request->status;//form
            $Coupon->save();
            return redirect()->route('admin.coupon.index')->with('success', 'Thêm thành công.');
         
    
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
        $coupon=Coupon::find($id);
        $list = Coupon::get();
      
        return view("backend.coupon.edit",compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Coupon = Coupon::find($id);
        if (!$Coupon) {
            return redirect()->route('admin.coupon.index')->with('error', 'Coupon not found');
        }
        $Coupon->coupon_name=$request->name; //form
        $Coupon->coupon_time=$request->time; //form
        $Coupon->coupon_condition=$request->condition; //form
        $Coupon->coupon_number=$request->number; //form
        $Coupon->coupon_code=$request->code; //form
        $Coupon->updated_at = date('Y-m-d H:i:s');
        $Coupon->status=$request->status;//form
        if ($Coupon->save()) {
            // Chuyển hướng người dùng về trang danh sách Coupon với thông báo thành công
            
            return redirect()->route('admin.coupon.index')->with('success', 'Cập nhật thành công');
        }
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.coupon.index')->with('error', 'Failed to update Coupon.');
    }
    /**
     * Remove the specified resource from storage.
     */

     public function status(string $id){
        $Coupon = Coupon::find($id);
        if($Coupon){
            $Coupon->status = $Coupon->status == 1 ? 2 : 1;
            $Coupon->save();
        } else {
            $Coupon = new Coupon();
            $Coupon->id = $id; // Ensure the new Coupon has the provided ID
            $Coupon->status = 1; // Default value or another value as needed
            $Coupon->save();
        }
     
    
        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.coupon.index')->with('success', 'Cập nhật thành công');
     }
     public function destroy(string $id)
     {
         $Coupon = Coupon::find($id);
         if ($Coupon) {
             // Set the Coupon status to 0
             $Coupon->status = 0;
     
         }
             $Coupon->save();
         // Redirect with success message
         return redirect()->route('admin.coupon.index')->with('success', 'thêm vào thùng rác thành công');
        }
        public function trash(){
            $list = Coupon::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
            return view("backend.coupon.trash",compact("list"));
        }
        public function restore(string $id)
        {
            $Coupon = Coupon::find($id);
            if ($Coupon) {
                // Set the Coupon status to 0
                $Coupon->status = 1;
        
            }
                $Coupon->save();
            // Redirect with success message
            return redirect()->route('admin.coupon.trash')->with('success', 'khôi phục thành công.');
           }
           public function delete(string $id)
           {
               $Coupon = Coupon::find($id);
               
                   // Set the Coupon status to 0
                   $Coupon->delete();
           
               // Redirect with success message
               return redirect()->route('admin.coupon.trash')->with('success', 'Xóa thành công.');
              }
}