<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tags extends Component
{
    public string $orientation;
    public iterable $tags = [];

    /**
     * Create a new component instance.
     */
    public function __construct(iterable $tags = [], string $orientation = "horizontal")
    {
        $this->tags = $tags;
        $this->orientation = $orientation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tags');
    }
}
