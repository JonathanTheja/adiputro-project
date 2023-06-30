<?php

namespace App\View\Components;

use App\Models\ItemLevel;
use Illuminate\View\Component;

class DataLevel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public ItemLevel $item,public $level,public $max)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-level');
    }
}
