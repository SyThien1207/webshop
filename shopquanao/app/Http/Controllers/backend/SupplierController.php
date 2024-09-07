<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Request $request){
        $query = Supplier::where ('status','!=',0);
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Supplier::where('status', 1)->count();
        $activeCategoryCount1 = Supplier::all()->count();
        $activeCategoryCount2 = Supplier::where('status', 0)->count();

      

        return view("backend.supplier.index", compact("list",   "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }
    public function store(Request $request)
    {
        $category = new Supplier();
        $category->name = $request->name;
        $category->contact_person = $request->contact_person;
        $category->email = $request->email;
        $category->phone = $request->phone;
        $category->address = $request->address;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = Auth::id() ?? 1;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('admin.supplier.index');
    }
    public function edit(string $id){
        $list= Supplier::find($id);
        return view('backend.supplier.edit', compact('list'));

    }
    public function update(Request $request, string $id)
    {
        // Lấy category từ database
        $supplier = Supplier::findOrFail($id);
        if (!$supplier) {
            return redirect()->route('admin.supplier.index')->with('error', 'supplier not found.');
        }
        $supplier->name = $request->name;
        $supplier->contact_person = $request->contact_person;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        
        $supplier->updated_at = date('Y-m-d H:i:s');
        $supplier->updated_by = Auth::id() ?? 1;
        $supplier->status = $request->status;

        if ($supplier->save()) {
            return redirect()->route('admin.supplier.index')->with('success', 'Category updated successfully.');
        }
        return redirect()->route('admin.supplier.index')->with('error', 'Failed to update category.');
    }
    
    public function status(string $id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->status = $supplier->status == 1 ? 2 : 1;
            $supplier->save();
        } else {
            $supplier = new Supplier();
            $supplier->id = $id; // Ensure the new supplier has the provided ID
            $supplier->status = 1; // Default value or another value as needed
            $supplier->save();
        }


        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.supplier.index')->with('success', 'supplier updated successfully.');
    }
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            // Set the supplier status to 0
            $supplier->status = 0;
        }
        $supplier->save();
        // Redirect with success message
        return redirect()->route('admin.supplier.index')->with('success', 'supplier updated successfully.');
    }
    public function trash()
    {
        $list = Supplier::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view("backend.supplier.trash", compact("list"));
    }
    public function restore(string $id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            // Set the supplier status to 0
            $supplier->status = 2;
    
        }
            $supplier->save();
        // Redirect with success message
        return redirect()->route('admin.supplier.trash')->with('success', 'supplier updated successfully.');
       }
      public function delete(string $id){
        $list = Supplier::findOrFail ( $id );
        $list->delete ();
        return redirect()->route ( 'admin.supplier.trash' )->with ('success', 'Supplier deleted successfully.' );
      }
       
}
