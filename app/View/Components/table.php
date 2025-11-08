<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public array $headers;
    public iterable $rows;
    public bool $hasActions;
    public $actions;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $headers = [],
        $rows = [],
        $hasActions = false,
        Closure $actions = null
    ) {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->hasActions = $hasActions;
        $this->actions = $actions;
    }

    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
