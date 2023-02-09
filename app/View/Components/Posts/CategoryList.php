<?php

namespace App\View\Components\Posts;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = cache()->remember('post_categories', 60, function () {
            return Category::where('type', 'postCategory')->withCount('posts')->get();
        });
        return view('components.posts.category-list', [
            'categories' => $categories,
        ]);
    }
}
