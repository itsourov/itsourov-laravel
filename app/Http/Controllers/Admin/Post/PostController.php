<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('media')->filter(request(['categories', 'search']))->latest()->withTrashed()->withCount('comments')->paginate(10);

        return view('admin.posts.index', [
            "posts" => $posts,
        ]);
    }
    public function create()
    {
        $categories = Category::where('type', 'postCategory')->get();

        return view('admin.posts.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Category::whereIn('id', request('categories'))->get()->toArray());
        $formFields = $request->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'content' => 'required',
            'categories' => 'required',
            'thumbnail' =>  ['required']
        ]);
        $formFields['user_id'] = auth()->id();
        $formFields['excerpt'] =  substr(strip_tags($request['content']), 0, 47) . '...';


        $temporaryFile = TemporaryFile::where('folder', $request->thumbnail)->first();
        $post = Post::create($formFields);
        if ($temporaryFile) {

            $post->addMedia(storage_path('app/public/temp/thumbnail/' . $request->thumbnail . '/' . $temporaryFile->filename))
                ->withResponsiveImages()
                ->toMediaCollection('thumbnails');
            Storage::deleteDirectory('public/temp/thumbnail/' .  $request->thumbnail);
            $temporaryFile->delete();
        }

        foreach (Category::whereIn('id', $request->categories)->get() as $category) {

            $category->posts()->attach([$post->id]);
        }
        return redirect(route('admin.posts.create'))->with('message', 'Post submitted');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('type', 'postCategory')->get();
        return view('admin.posts.edit', [

            "post" => $post->loadMissing(['categories:id']),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $formFields = $request->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'content' => 'required',
            // 'categories' => 'required',

        ]);
        $formFields['user_id'] = auth()->id();



        $temporaryFile = TemporaryFile::where('folder', $request->thumbnail)->first();
        $post->update($formFields);
        if ($temporaryFile) {

            if ($request->oldId) {
                $post->deleteMedia($request->oldId);
            }

            $post->addMedia(storage_path('app/public/temp/thumbnail/' . $request->thumbnail . '/' . $temporaryFile->filename))
                ->withResponsiveImages()
                ->toMediaCollection('thumbnails');
            Storage::deleteDirectory('public/temp/thumbnail/' .  $request->thumbnail);
            $temporaryFile->delete();
        }

        foreach (Category::whereIn('id', $request->categories)->get() as $category) {

            $category->posts()->syncWithoutDetaching([$post->id]);
        }
        return redirect(route('admin.posts', $post))->with('message', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('admin.posts'))->with('message', 'Post Deleted');
    }
}