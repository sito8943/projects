<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public string $title;
    public string $action;
    public string $button;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $action = "", string $button = "")
    {
        $this->title = $title;
        $this->action = $action;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
