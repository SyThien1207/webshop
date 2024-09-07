<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Topic::where('status', '!=', 0);

        // Apply search filter if there is a search term
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Order by created_at and paginate
        $list = $query->orderBy('created_at', 'desc')->paginate(10);
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau: " . $item->name . "</option>";
        }
        $activeCategoryCount = Topic::where('status', 1)->count();
        $activeCategoryCount1 = Topic::all()->count();
        $activeCategoryCount2 = Topic::where('status', 0)->count();

        return view("backend.topic.index", compact("list","htmlsortorder", "activeCategoryCount", "activeCategoryCount1", "activeCategoryCount2"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->description = $request->description;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->updated_at = $request->updated_at;
        $topic->created_by = Auth::id()??1;
        $topic->updated_by = $request->updated_by;
        $topic->status = $request->status;
      
        if ($topic->save()) {
            // Redirect the user back to the topic index with success message
            return redirect()->route('admin.topic.index')->with('success', 'Topic created successfully.');
        }
    
        // If saving fails, redirect with error message
        return redirect()->route('admin.topic.index')->with('error', 'Failed to update topic.');
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
        $topic=Topic::find($id);
        $list = Topic::where('status', '!=', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
          
            if ($topic->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>sau " . $item->name . "</option>";
            }
            
          
        }
                return view("backend.topic.edit",compact("topic","htmlsortorder"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $topic = Topic::find($id);
    
    // If topic not found, redirect back with error message
    if (!$topic) {
        return redirect()->route('admin.topic.index')->with('error', 'Topic not found');
    }

    // Update topic attributes with new data from the request
    $topic->name = $request->name;
    $topic->description = $request->description;
    $topic->status = $request->status;
    
    // Check if sort_order is provided in the request
    if ($request->has('sort_order')) {
        $topic->sort_order = $request->sort_order;
    }

    // Save the updated topic
    if ($topic->save()) {
        // Redirect the user back to the topic index with success message
        return redirect()->route('admin.topic.index')->with('success', 'Topic updated successfully.');
    }

    // If saving fails, redirect with error message
    return redirect()->route('admin.topic.index')->with('error', 'Failed to update topic.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $topic = Topic::find($id);
        if ($topic) {
            $topic->status = $topic->status == 1 ? 2 : 1;
            $topic->save();
        } else {
            $topic = new topic();
            $topic->id = $id; // Ensure the new topic has the provided ID
            $topic->status = 1; // Default value or another value as needed
            $topic->save();
        }


        // Nếu lưu không thành công, chuyển hướng với thông báo lỗi
        return redirect()->route('admin.topic.index')->with('success', 'topic updated successfully.');
    }
    public function destroy(string $id)
    {
        $topic = topic::find($id);
        if ($topic) {
            // Set the topic status to 0
            $topic->status = 0;
        }
        $topic->save();
        // Redirect with success message
        return redirect()->route('admin.topic.index')->with('success', 'topic updated successfully.');
    }
    public function trash()
    {
        $list = topic::where('status', '=', 0)
        ->orderBy('created_at','desc')
        ->get();
      
        
        return view("backend.topic.trash", compact("list"));
    }
    public function restore(string $id)
    {
        $topic = topic::find($id);
        if ($topic) {
            // Set the topic status to 0
            $topic->status = 1;
        }
        $topic->save();
        // Redirect with success message
        return redirect()->route('admin.topic.trash')->with('success', 'topic updated successfully.');
    }
    public function delete(string $id)
    {
        $topic = topic::find($id);

        // Set the topic status to 0
        $topic->delete();

        // Redirect with success message
        return redirect()->route('admin.topic.trash')->with('success', 'topic updated successfully.');
    }
}
