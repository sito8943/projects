<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tags extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(public iterable $tags = [], public bool $admin = false, public string $orientation = "horizontal")
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tags');
    }
}
