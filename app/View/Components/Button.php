<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;
    public string $size;
    public bool $outline;
    public bool $block;
    public bool $loading;
    public bool $disabled;
    public bool $autoLoading; // <--- baru

    public function __construct(
        string $variant = 'primary',
        string $size = 'md',
        bool $outline = false,
        bool $block = false,
        bool $loading = false,
        bool $disabled = false,
        bool $autoLoading = false,
    ) {
        $this->variant = $variant;
        $this->size = $size;
        $this->outline = $outline;
        $this->block = $block;
        $this->loading = $loading;
        $this->disabled = $disabled;
        $this->autoLoading = $autoLoading;
    }

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
