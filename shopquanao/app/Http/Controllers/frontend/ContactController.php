<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view("frontend.contact");
    }
    public function contact(Request $request)
    {
        
            $banner=new Contact();
            $banner->name=$request->name; //form
            $banner->user_id= Auth::id(); //form
            $banner->email=$request->email;
            $banner->content=$request->content;//form
            $banner->created_at=date('Y-m-d H:i:s');
            $banner->status=2;//form
           
            
            $banner->save();
            return redirect()->route('home.index')->with('success', 'Gửi liên hệ thành công.');   
         
    
    }
}
