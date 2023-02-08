<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $posts = Post::Filter(request(['categories', 'search']))->latest()->withCount('comments')->with('media')->paginate(10);
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

        $loadedPost =  ($post->loadMissing(['user.media', 'categories', 'comments.user.media',]));
        // return $loadedPost;
        return view('posts.details', [
            'post' => $loadedPost,




        ]);
    }
}
