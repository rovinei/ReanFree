<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\CategoryType;
use App\Models\Category;

class VisitorPage
{

    protected $menus;
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->menus = Category::whereNull('parent_id')->with('children')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with([
            'menus' => $this->menus
        ]);
    }
}
