<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $color;
    public string $size;
    public bool $soft;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $color = 'primary',
        string $size = 'sm',
        bool $soft = true
    ) {
        $this->color = $color;
        $this->size = $size;
        $this->soft = $soft;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
