<?php

namespace App\View\Components\Posts;

use App\Models\Post;
use Illuminate\View\Component;

class PopularPosts extends Component
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
        $popularPosts =  cache()->remember('popular-posts', 60, function () {
            return Post::take(5)->get();
        });
        return view('components.posts.popular-posts', [
            'popularPosts' => $popularPosts,
        ]);
    }
}