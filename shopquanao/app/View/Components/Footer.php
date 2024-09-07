<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Configuration;

class Footer extends Component
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
        $listmenu = Menu::where([
            ['status', '=', 1],
            ['position', '=', 'footer'],

        ])->orderBy('sort_order', 'asc')->limit(6)->get();
        $category = Menu::where([['status', '=', 1], ['parent_id', '>', 0]])
        ->orderBy('sort_order', 'asc')->get();
        $listpost = Post::where([
            ['status', '=', 1],
            ['type', '=', 'page'],

        ])->get();
        return view('components.footer', compact('listmenu', 'listpost','category'));
    }
}
