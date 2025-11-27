<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectsIndexLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title)
    {
        // Sidebar is always shown in this layout
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projects-index-layout');
    }
}

