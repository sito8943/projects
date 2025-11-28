<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

use App\Models\Tag;

class ProjectsIndexLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public Collection $tags)
    {
        $this->tags = Tag::query()
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projects-index-layout');
    }
}

