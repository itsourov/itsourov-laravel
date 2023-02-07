<x-admin-layout>


    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>


    <script type="module">
        tinymce.init({
            content_css: "https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css",
            importcss_append: true,
            relative_urls: false,
            remove_script_host: false,
            selector: '#textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            skin: "oxide-dark",
            content_css: "dark",
            toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | gallery",
            file_picker_types: 'image',
           
            /* and here's our custom image picker*/
            images_upload_url: '{{ route('posts.image.upload') . '?_token=' . csrf_token() }}',
            images_upload_base_path: '{{ route('home') }}',
    
            setup: function(editor) {
                editor.ui.registry.addButton('gallery', {
                    text: 'My Gallery',
                    icon: 'gallery',
                    onAction: function(_) {
                        $('#image').val('');
                        tinyMCE.activeEditor.windowManager.open({
                            title: 'Previous Gallery', // The dialog's title - displayed in the dialog header
                            size: 'large',
                            
                            body: {
                                type: 'panel', // The root body type - a Panel or TabPanel
                                items: [ // A list of panel components
                                    {
                                        type: 'htmlpanel',
                                        html: `<livewire:post.image-gallery />`

                                    }
                                ]
                            },
                            buttons: [{
                                    type: 'cancel',
                                    name: 'closeButton',
                                    text: 'Cancel'
                                },
                                {
                                    type: 'submit',
                                    name: 'submitButton',
                                    text: 'Insert To Editor',
                                    primary: true
                                }
                            ],
                            onSubmit: function(api) {
                                var data = api.getData();
                                let source = $('#image').val();

                                if (source != '') {
                                    editor.focus();
                                    editor.selection.setContent('<img style="width: 100%;"  src="' + source +
                                        '" />');
                                    api.close();
                                } else {
                                    alert("Please select an image.");
                                }
                            }
                        });
                    }
                });
            },
        });
        $(document).on('click', '.gallery-div > img', function() {
            $('.gallery-div > img').removeClass('active');
            $(this).addClass('active');
           
            $('#image').val($(this).attr('src'));
        });
    </script>
    <style>
        .active {
            outline: none !important;
            border: 1px solid red;
            box-shadow: 0 0 10px #719ECE;
        }
    </style>

    <section class="my-10 px-2 md:px-5">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16 bg-white dark:bg-gray-800 shadow rounded-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Post</h2>
            <form action="{{ route('admin.posts.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="sm:col-span-2">
                        <x-input-label for="post_title" :value="__('Post title')" />
                        <x-text-input id="post_title" placeholder="Title here" name="title" type="text"
                            class="mt-1 block w-full" :value="old('title')" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="post_slug" :value="__('Post Slug')" />
                        <x-text-input id="post_slug" placeholder="Permalink here" name="slug" type="text"
                            class="mt-1 block w-full" :value="old('slug')" />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>


                    <div class="w-full">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>

                        <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                            class="inline-flex items-center justify-between w-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button">Select category<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg></button>

                        <!-- Dropdown menu -->
                        <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">

                            <ul class="h-48 px-3 py-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownSearchButton">
                                @foreach ($categories as $category)
                                    <li>
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="checkbox-item-{{ $category->id }}" type="checkbox"
                                                value="{{ $category->id }}" name="categories[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-{{ $category->id }}"
                                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $category->title }}</label>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                            <a href="{{ route('admin.posts.categories') }}"
                                class="flex items-center p-3 text-sm font-medium text-green-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-green-500 hover:underline">

                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z">
                                    </path>
                                </svg>
                                Add Category
                            </a>
                        </div>


                        @error('categories')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>






                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload
                            file</label>
                        <input type="file" id="thumbnail" name="thumbnail">

                        @error('thumbnail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>




                    <div class="sm:col-span-2">
                        <label for="content"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>





                        <input type="text" name="content" id="textarea" value="{{ old('content') }}" />

                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    {{ __('Add Post') }}
                </button>
            </form>
        </div>
    </section>

    <style>
        .tox-statusbar__branding {
            display: none;
        }

        .tox-tinymce {
            border: none;
        }

        .tox-promotion {
            display: none;
        }
    </style>



    <script type="module">
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="thumbnail"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        // Only accept images
        acceptedFileTypes: ['image/*'],

    });
    FilePond.setOptions({
        allowImageCrop: true,
        server: {
            url: '/upload',


            headers: {
                'X-CSRF-TOKEN': '{!! csrf_token() !!}',
            }

        },
    });
</script>


    <script>
        const titleInput = document.getElementById("post_title")
        titleInput.addEventListener('input', function(evt) {

            var b = this.value.toLowerCase().replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            document.getElementById("post_slug").value = b;
        });

        window.onbeforeunload = function() {
            return "Your work will be lost.";
        };
    </script>
</x-admin-layout>
