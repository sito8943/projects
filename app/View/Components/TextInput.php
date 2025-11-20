<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public string $name;
    public string $label;
    public string $value = "";
    public string $placeholder = "";
    public string $id = "";
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string $id = "", string $placeholder = "", string $value = "", bool $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
