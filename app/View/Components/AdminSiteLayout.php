<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSiteLayout extends Component
{
    public string $title;
    public bool $showSidebar;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title = 'Proctique', bool $showSidebar = true)
    {
        $this->title = $title;
        $this->showSidebar = $showSidebar;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.site-layout');
    }
}
