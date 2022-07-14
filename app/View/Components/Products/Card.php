<?php

namespace App\View\Components\Products;

use App\Models\Product;
use Illuminate\View\Component;

class Card extends Component
{
    public Product $product;
    public $likes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product, $likes)
    {
        $this->product = $product;
        $this->likes = $likes;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products.card');
    }
}
