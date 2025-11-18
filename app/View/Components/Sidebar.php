<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\Tag;

class Sidebar extends Component
{
    public Collection $tags;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $tags = Tag::all();
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
