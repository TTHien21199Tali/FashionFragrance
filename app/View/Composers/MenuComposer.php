<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $menus = Menu::select('id','name','parent_id')->where('active',1)->orderByDesc('id')->get();
        $view->with('menus', $menus);
    }
}