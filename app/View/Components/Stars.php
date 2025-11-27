<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stars extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?float $value = null,
        public int $max = 5,
        public mixed $for = null,
        public mixed $reviews = null,
        public bool $withCount = false,
        public int $round = 0,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        [$displayValue, $count] = $this->compute();

        return view('components.stars', [
            'displayValue' => $displayValue,
            'count' => $count,
        ]);
    }

    /**
     * Compute average rating and count when needed.
     * - If an explicit numeric value is provided, use it.
     * - Else, compute from provided reviews collection or from model's `reviews` relation.
     *
     * @return array{0:int,1:int}
     */
    protected function compute(): array
    {
        // Explicit value wins
        if ($this->value !== null) {
            $val = (float) $this->value;
            $rounded = $this->round > 0 ? round($val, $this->round) : round($val);
            return [max(0, min((int) $rounded, $this->max)), 0];
        }

        // Collect reviews either from prop or from a model's relation
        $reviews = $this->reviews;
        if ($reviews === null && $this->for && method_exists($this->for, 'getRelation') && $this->for->relationLoaded('reviews')) {
            $reviews = $this->for->reviews;
        } elseif ($reviews === null && $this->for && property_exists($this->for, 'reviews')) {
            // Attempt to access lazily if available
            try {
                $reviews = $this->for->reviews;
            } catch (\Throwable) {
                $reviews = null;
            }
        }

        $count = 0;
        $avg = 0.0;
        if ($reviews && method_exists($reviews, 'avg')) {
            $avg = (float) ($reviews->avg('stars') ?? 0);
            $count = (int) ($reviews->count() ?? 0);
        }

        $rounded = $this->round > 0 ? round($avg, $this->round) : round($avg);
        $display = max(0, min((int) $rounded, $this->max));

        return [$display, $count];
    }
}
