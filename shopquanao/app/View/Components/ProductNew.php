<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductNew extends Component
    {
    /**
     * Create a new component instance.
     */
    public function __construct ()
        {
        //
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render () : View|Closure|string
        {
        $product_new = Product::where ( [['status', '=', '1'],['qty', '>', '0']] )
            ->orderBy ( 'created_at', 'desc' )->limit ( 6 )->get ();
        return view ( 'components.product-new', compact ( 'product_new' ) );
        }
    }
