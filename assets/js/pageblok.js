$(document).ready(function () {

    //
    // TITLE DESCRIPTION
    //
    if ($('#description').length && $('#title').length) {
        $(document).on('input', '#title', function () {
            var $titleField = $(this);

            var previousValue = $titleField.val().substring(0, $titleField.val().length - 1);
            if ($('#description').val() === previousValue || $('#description').val().length === 0) {
                $('#description').val($titleField.val());
            }
        });
    }

    //
    // Upload image
    //
    function uploadAsset(file, editor, welEditable) {
        var data = new FormData();
        data.append("file", file[0]);
        $.ajax({
            data: data,
            type: "POST",
            url: "/assets/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    editor.insertImage(welEditable, data.message);
                } else {
                    alert(data.message);
                }
            }
        });
    }

    // Preview image before upload
    function previewImage(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader(),
                maxWidth = $('a.img-remove').width();

            reader.onload = function (e) {
                $('div.image-preview').html('<img id="img-thumbnail center" width="' + maxWidth + 'px" src="' + e.target.result + '" />');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_ref").change(function(){
        previewImage(this);
        $('a.img-remove').show(100);
    });

    $('a.img-remove').click(function() {
        $('div.image-preview').html('');
        if ($('#remove_image')) {
            $('#remove_image').val('1');
        }
        $("#image_ref").val('');
        $(this).hide(100);
    })

    //
    // CONTENT EDITOR
    //
    if ($('#content_type').length) {
        $(document).on('change', '#content_type', function () {
            var $selectBox = $(this);
            if ('markdown' === $selectBox.val()) {
                $('textarea.content-editor').destroy();
            } else { // current version you can choose between markdown or html
                $('textarea.content-editor').summernote({
                    height: 300,
                    fontNames: [
                        'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                        'Helvetica Neue', 'Impact', 'Lato', 'Lucida Grande',
                        'Tahoma', 'Times New Roman', 'Verdana'
                    ],
                    defaultFontName: 'Lato',
                    onImageUpload: function (file, editor, editable) {
                        console.log('image upload:', file, editor, editable);
                        uploadAsset(file, editor, editable);
                    }
                });

                $('form.editor-form').on('submit', function () {
                    $('textarea[name="content"]').html($('textarea.content-editor').code());
                });

            }
        });

        // trigger it on pageload
        $('#content_type').change();
    }

    // TUSANA ITEM LIST CHANGES
    $('table.pageblok-item-list input[type=checkbox]').change(function() {
        var checkedCount = $('table.pageblok-item-list :checked').length;
        if (this.checked || (0 < checkedCount)) {
            $('.extra-actions').show(100);
        } else {
            $('.extra-actions').hide(100);
        }
    });
});