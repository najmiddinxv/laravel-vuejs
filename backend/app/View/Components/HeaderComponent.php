<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public $menuItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = $this->getMenuItems();

    }

    private function getMenuItems()
    {

        //bu yerda menu cheksiz vaqtga keshlandi
        $cachedMenu = Cache::rememberForever('menu', function () {
            return Menu::with('children')
            ->whereNull('parent_id')
            ->where('position',Menu::HEADER_MENU)
            ->orderBy('menu_order','asc')
            ->get();
        });

        return $cachedMenu;

        // //bu yerda 60 bu daqiqa yani 1 soat degani. 1 soatga keshga olayapti
        // return Cache::remember('menu', 60, function () {
        //     return Menu::all();
        // });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.components.header-component');
    }








    //buni birorta controllerga yozsa bo'ladi
    // public function renderMenu()
    // {
    //     $menuItems = Menu::with('children')->whereNull('parent_id')->get();
    //     $renderedMenu = $this->renderMenuItems($menuItems);

    //     return view('menu.index', ['renderedMenu' => $renderedMenu]);
    // }

    // // Recursive function to render menu and its children
    // private function renderMenuItems($items)
    // {
    //     $html = '<ul>';
    //     foreach ($items as $item) {
    //         $html .= '<li>';
    //         if ($item->children->count() > 0) {
    //             $html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $item->name . '</a>';
    //             $html .= '<ul class="dropdown-menu">';
    //             $html .= $this->renderMenuItems($item->children);
    //             $html .= '</ul>';
    //         } else {
    //             $html .= '<a href="' . url($item->url) . '">' . $item->name . '</a>';
    //         }
    //         $html .= '</li>';
    //     }
    //     $html .= '</ul>';
    //     return $html;
    // }

}
