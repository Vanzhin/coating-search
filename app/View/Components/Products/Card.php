<?php

namespace App\View\Components\Products;

use App\Models\Compilation;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\Component;

class Card extends Component
{
    public Product $product;
    public $likes;
    public ?Compilation $compilation;
    public ?User $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $likes, $compilation = null, $user = null)
    {
        $this->product = $product;
        $this->likes = $likes;
        $this->compilation = $compilation;
        $this->user = $user;

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
