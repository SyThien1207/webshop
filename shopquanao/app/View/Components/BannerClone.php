<?php

namespace App\View\Components;

use App\Models\Banner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerClone extends Component
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
        $list_banner = Banner::where([['position', '=', 'banner-clone'], ['status', '=', '1']])-> orderBy('created_at','desc') 
        ->limit(3)->get();


        return view('components.banner-clone',compact('list_banner'));

    }
}
