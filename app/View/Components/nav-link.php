<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Link href (route/url tujuan)
     */
    public string $href;

    /**
     * Apakah link ini aktif (true kalau route cocok)
     */
    public bool $active;

    /**
     * Buat instance baru dari NavLink
     */
    public function __construct(string $href, bool $active = false)
    {
        $this->href = $href;
        $this->active = $active;
    }

    /**
     * Render komponen
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
