<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $post_new = Post::where([['posts.status', '=', '1'], ['posts.type', '=', 'post']])
        ->join('users', 'posts.created_by', '=', 'users.id')
        ->orderBy('posts.created_at', 'desc')
        ->select('posts.*', 'users.name as user_name')
        ->limit(6)
        ->get();
    return view('components.post-card', compact('post_new'));
    
    }
}
