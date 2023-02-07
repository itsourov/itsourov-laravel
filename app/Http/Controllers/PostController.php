<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $posts = Post::with('media')->Filter(request(['categories', 'search']))->latest()->withCount('comments')->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.details', [
            'post' => $post->loadMissing(['categories', 'comments']),




        ]);
    }
}