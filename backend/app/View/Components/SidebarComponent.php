<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Image;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SidebarComponent extends Component
{
    public $categories;
    public $images;

    public function __construct()
    {
        $this->categories = $this->getCategories();
        $this->images = $this->getImages();

    }

    private function getCategories()
    {
        $categories = Category::withCount(['posts','news','pages'])
            // ->whereNull('parent_id')
            ->latest('id')
            ->get();

        return $categories;
    }

    private function getImages()
    {
        $images = Image::inRandomOrder()->limit(6)->get();
        return $images;
    }


    public function render(): View|Closure|string
    {
        return view('frontend.components.sidebar-component');
    }
}
