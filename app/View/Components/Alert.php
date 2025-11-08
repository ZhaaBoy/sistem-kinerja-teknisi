<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Closure;

class Alert extends Component
{
    public string $type;
    public string $message;

    public function __construct(?string $type = 'success', ?string $message = '')
    {
        $this->type = $type ?? 'success';
        $this->message = $message ?: session('message', '');
    }

    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
