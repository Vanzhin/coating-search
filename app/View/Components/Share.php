<?php

namespace App\View\Components;

use App\Models\Compilation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Share extends Component
{
    public Model $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.share.share');
    }
}
