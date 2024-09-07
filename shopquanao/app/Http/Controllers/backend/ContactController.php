<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = Contact::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);

        $activeCategoryCount = Contact::where('status', 2)->count();
        $activeCategoryCount1 = Contact::all()->count();
        $activeCategoryCount2 = Contact::where('status', 0)->count();



        return view("backend.contact.index", compact("list", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }
    public function reply($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }

        // Cập nhật trạng thái của contact


        return view('backend.contact.reply', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        $post = new Reply();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = 1;
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = Auth::id() ?? 1;        //upload file
        $post->save();
        
        return redirect()->route('admin.contact.index');
    }
    public function status(string $id)
    {
        $category = Contact::find($id);
        $category->status = 1;  // Giả sử trạng thái 2 là "Đã trả lời"
        $category->save();


        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.contact.index')->with('success', 'Đã trả lời.');
    }
    public function destroy(string $id)
    {
        $category = Contact::find($id);
        if ($category) {
            // Set the category status to 0
            $category->status = 0;
        }
        $category->save();
        // Redirect with success message
        return redirect()->route('admin.contact.index')->with('success', 'Xóa liên hệ');
    }
}
