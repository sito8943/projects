<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectImage extends Component
{
    public string $url = '';
    /**
     * Create a new component instance.
     */
    public function __construct(public Project $project, public string $conversion = 'default', public string $class = '', public string $alt = '')
    {
        $this->url = $project?->getFirstMediaUrl('default', $conversion);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-layout');
    }
}
