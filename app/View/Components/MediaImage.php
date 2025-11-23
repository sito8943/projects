<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\HasMedia;

class MediaImage extends Component
{
    public string $url = '';

    public function __construct(
        public HasMedia $model,
        public string $collection = 'default',
        public string $conversion = 'default',
        public string $class = '',
        public string $alt = ''
    ) {
        $this->url = $model?->getFirstMediaUrl($collection, $conversion);
    }

    public function render(): View|Closure|string
    {
        return view('components.media-image');
    }
}

