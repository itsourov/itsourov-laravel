<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  Category::withCount('posts')->latest()->paginate(10);
        return view('admin.posts.categories', ['categories' => $categories]);
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
        return redirect(route('admin.posts.categories'))->with('message', 'Category submitted');
    }
}