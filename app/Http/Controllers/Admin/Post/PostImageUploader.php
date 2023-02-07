<?php

namespace App\Http\Controllers\Admin\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\PostImage;
use Barryvdh\Debugbar\Facades\Debugbar;

class PostImageUploader extends Controller
{
    public function store(Request $request)
    {
        Debugbar::disable();


        $fileName = $request->file('file')->getClientOriginalName();

        $newPostImage =  PostImage::create([
            'title' => $fileName,
        ]);
        $pathToStore = 'uploads/post-image/' . $newPostImage->id;
        $path = $request->file('file')->storeAs($pathToStore, $fileName, 'public');


        return response()->json(['location' => "/storage/$path"]);
    }
}