<?php

namespace App\View\Components\Products;

use App\Models\Compilation;
use App\Models\Product;
use Illuminate\View\Component;

class Card extends Component
{
    public Product $product;
    public $likes;
    public ?Compilation $compilation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $likes, $compilation = null)
    {
        $this->product = $product;
        $this->likes = $likes;
        $this->compilation = $compilation;

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
