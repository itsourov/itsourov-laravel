import './sidebar';



var editor_config = {
    path_absolute: "/",
    selector: '.tinymceEditor',
    relative_urls: false,
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    skin: "oxide-dark",
    content_css: "dark",
    extended_valid_elements: 'img[class|src|alt|title|width|loading=lazy]',
    setup: function (editor) {
        editor.on('ExecCommand', function (e) {
            if (e.command === 'mceUpdateImage') {
                const img = editor.selection.getNode();
                img.setAttribute('data-src', img.src);
               
        
            }
        });
    },
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback: function (callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
            'body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document
            .getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {



                callback(message.content);

                console.log(message)



            }
        });
    }
};

tinymce.init(editor_config);




