<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenu extends Component
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
            ['position', '=', 'mainmenu'],
            ['parent_id', '=', null],
            
        ])->orderBy('sort_order', 'asc')->limit(6)->get();

        return view('components.main-menu', compact('listmenu'));
    }
}
