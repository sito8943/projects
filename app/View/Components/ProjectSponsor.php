<?php

namespace App\View\Components;

use App\Models\Project;
use App\Models\Purchase;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProjectSponsor extends Component
{
    public function __construct(
        public Project $project,
        public ?Collection $sponsors = null,
        public ?Purchase $activePurchase = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.project-sponsor');
    }
}
