<div class="gallery-div"><input type="hidden" id="image" />

    @foreach ($images as $image)
        <img class="  w-40 max-w-full inline-flex h-min object-cover object-center   overflow-clip"
            src=" {{ route('home') . '/storage/uploads/post-image/' . $image->id . '/' . $image->title }}">
    @endforeach
</div>
