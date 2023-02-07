<?php // routes/breadcrumbs.php

use App\Models\Post;
use Diglactic\Breadcrumbs\Breadcrumbs;


// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('post', function ($trail, Post $post) {
    $trail->parent('home');
    foreach ($post->categories as $category) {
        $trail->push($category->title, route('categories.details', $category->slug));
    }
    $trail->push($post->title, route('posts.details', $post));
});;

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');

    $trail->push($category->title, route('categories.details', $category));
});

// Home > search > [search]
Breadcrumbs::for('search', function ($trail, $query) {
    $trail->parent('home');

    $trail->push("Search", route('posts.search'));
    $trail->push($query, route('posts.search'));
});