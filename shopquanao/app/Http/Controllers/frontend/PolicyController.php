<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post_list = Post::where ( [['type', '=', 'page'],['id','!=',$post->id]] )->orderBy ( 'created_at', 'desc' )->get ();

        return view("frontend.policy",compact("post","post_list"));
    }

}
