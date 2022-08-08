<?php

namespace App\View\Components\Products\Actions;

use App\Models\Product;
use Illuminate\View\Component;

class Compilation extends Component
{
    public Product $product;
    public ?\App\Models\Compilation $compilation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product, $compilation = null)
    {
        $this->product = $product;
        $this->compilation = $compilation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products.actions.compilation');
    }
}
