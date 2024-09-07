<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   

    public function index()
{
    $activeCategoryCount1 = Product::all()->count();
    $activeCategoryCount2 = User::where('roles','=','customer')->count();
    $activeCategoryCount3 = Post ::where('type','=','post')->count();
    $activeCategoryCount4 = Contact ::where('status','=','2')->count();
        $orders = Order::select(DB::raw('count(*) as total_orders'))
        ->get();

    // Extract order counts and months
    $data = $orders->pluck('total_orders')->toArray();

   

    return view('backend.index', compact('data','activeCategoryCount1','activeCategoryCount2','activeCategoryCount3','activeCategoryCount4'));
}

}
