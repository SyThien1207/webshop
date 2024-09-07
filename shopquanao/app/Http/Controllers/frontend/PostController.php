<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
       
    }
    
    public function post_topic(Request $request, $slug)
    {
        $top = Topic::where('slug', $slug)->where('status', 1)->first();
    
        if (!$top) {
            // Handle the case where the topic is not found
            abort(404);
        }
    
        $productQuery = Post::where('status', 1)
            ->where('topic_id', '=', $top->id)
            ->where('type', '=', 'post');
    

        $list = $productQuery
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        return view("frontend.post-topic", compact("list", "top"));
    }
    
    public function allpost()
    {
        $list = Topic::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $productQuery = Post::where([['status', '=', 1],['type','=','post']]);
      
            $post_list=$productQuery->orderBy('created_at', 'desc')

            ->paginate(8);
        return view("frontend.post", compact("list", "post_list"));
    }
  

    public function post_detail(string $id)
    {
        $post = Post::find($id);
        $post_detail = Post::get();

        $list = Topic::where('status', '=', 1)
            ->get();
           
        $post_list = Post::where([['topic_id', '=', $post->topic_id], ['id', '!=', $post->id]])

            ->orderBy('created_at', 'desc')

            ->orderBy('created_at')
            ->limit(4)
            ->get();
            $post_new = Post::where([['status', '=', '1'], ['type', '=', 'post']])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        return view("frontend.post-detail", compact("post", "post_list","list","post_new"));
    }
}
