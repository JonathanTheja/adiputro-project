<?php

namespace App\View\Components;

use App\Models\Spk;
use Illuminate\View\Component;

class DataItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Spk $spk, public $level)
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
        return view('components.data-item');
    }
}
