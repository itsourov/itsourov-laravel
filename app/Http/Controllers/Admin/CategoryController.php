<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function PostCategoryIndex()
    {
        $categories =  Category::where('type', 'postCategory')->withCount('posts')->latest()->paginate(10);
        return view('admin.posts.categories', ['categories' => $categories]);
    }
    public function productCategoryIndex()
    {
        $categories =  Category::where('type', 'productCategory')->withCount('posts')->latest()->paginate(10);
        return view('admin.products.categories', ['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('categories', 'slug')],
            'type' => 'required',
            'description' => '',
        ]);

        Category::create($formFields);
        return back()->with('message', 'Category submitted');
    }
}
