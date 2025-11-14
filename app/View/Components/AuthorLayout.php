<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class AuthorLayout extends Component
{
    public bool $showLabel = true;
    public User $author;

    /**
     * Create a new component instance.
     */
    public function __construct(User $author, bool $showLabel = true)
    {
        $this->author = $author;
        $this->showLabel = $showLabel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.author-layout');
    }
}
