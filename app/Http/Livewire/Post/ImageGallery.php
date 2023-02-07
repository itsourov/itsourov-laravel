<?php

namespace App\Http\Livewire\Post;

use App\Models\PostImage;
use Livewire\Component;

class ImageGallery extends Component
{
    public  $images;
    public function render()
    {
        $this->images =  PostImage::all();
        return view('livewire.post.image-gallery');
    }
    public function refresh()
    {
        $this->render();
    }
}