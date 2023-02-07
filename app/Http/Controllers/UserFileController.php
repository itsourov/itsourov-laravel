<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserFileController extends Controller
{
    public function index(Media $media, $filename)
    {

        if (Auth::user() && $media->model_id == Auth::user()->id) {
            return response()->file(storage_path('app/user/' . $media->id . '/' . $filename));
        } else {
            return abort('403');
        }
    }

    public function getConversions(Media $media, $filename)
    {
        if (Auth::user() && $media->model_id == Auth::user()->id) {

            return response()->file(storage_path('app/user/' . $media->id . '/conversions/' . $filename));
        } else {
            return abort('403');
        }
    }
}