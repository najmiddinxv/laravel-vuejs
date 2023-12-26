<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public $menuItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = Menu::with('children')->whereNull('parent_id')->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.components.header-component');
    }
}
