<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
    {
    public function index ( Request $request )
        {

        $query = Order::where ( 'status', '!=', 0 );

        // Apply search filter if there is a search term
        if ( $request->has ( 'search' ) && $request->search != '' ) {
            $query->where ( 'title', 'like', '%' . $request->search . '%' );
            }

        // Order by created_at and paginate
        $list = $query->orderBy ( 'created_at', 'desc' )->paginate ( 10 );

        $activeCategoryCount  = Order::where ( 'status', '>', 1 )->count ();
        $activeCategoryCount1 = Order::all ()->count ();
        $activeCategoryCount2 = Order::where ( 'status', 0 )->count ();

        return view ( "backend.order.index", compact ( "list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2" ) );
        }
    public function status ( string $id )
        {
        $order = Order::find ( $id );
        switch ( $order->status ) {
            case 5:
                $order->status = 0;
                break;
                case 4:
                    // Update status to 3 and adjust product quantities
                    $order->status = 3;
        
                    // Get OrderDetail for this order
                    $orderDetails = OrderDetail::where('order_id', $id)->get();
        
                    foreach ($orderDetails as $detail) {
                        $product = Product::find($detail->product_id);
        
                        if ($product) {
                            // Subtract the quantity from the product
                            $product->qty -= $detail->qty;
                            $product->save();
                        }  
                    }
                    break;
            case 3:
                $order->status = 2;
                break;
            case 2:
                $order->status = 1;
                break;
            case 1:
                $order->status = 0;
                break;
            default:
                $order->status = 4; // Reset lại trạng thái nếu không khớp với các giá trị hiện có
                break;
            }

        $order->save ();

        return redirect ()->route ( 'admin.order.index' )->with ( 'success', 'Cập nhật trạng thái thành công.' );
        }
        
    public function destroy(string $id)
    {
        $category = Order::find($id);
        if ($category) {
            // Set the category status to 0
            $category->status = 5;
        }
        $category->save();
        // Redirect with success message
        return redirect()->route('admin.order.index')->with('success', 'Hủy thành công.');
    }
    public function detele(string $id){
        $category = Order::find($id);
        $row = OrderDetail::find ( $category->id );
            $row->delete();
            $category->delete();
        
        // Redirect with success message
        return redirect()->route('admin.order.index')->with('success', 'Xóa thành công.');
    }
    public function details($id)
{
        $order = Order::find ( $id );
    if (!$order) {
        return response()->json(['error' => 'order not found'], 404);
    }
        $row = OrderDetail::find ( $order->id );

    return view('backend.order.details', compact('order','row'));
}

    }
