jQuery(function($){

    // Upoad file dialog
    $('.uploadFile').on('click', function(e){
        e.preventDefault();
        var type = $(this).attr('data-type'),
            iframe = $('#fileManagerIframe'),
            uploadImageModal = UIkit.modal("#fileManagerModal");
        switch(type){
            case 'sound':
                $(iframe).attr(
                    'src',
                    "/admins/filemanager/dialog.php?type=2&field_id=sound_url'&fldr=musics"
                );
                break;
            case 'image':
                $(iframe).attr(
                    'src',
                    "/admins/filemanager/dialog.php?type=1&field_id=txtFeaturedImage'&fldr=images"
                );
                break;
            case 'video':
                $(iframe).attr(
                    'src',
                    "/admins/filemanager/dialog.php?type=3&field_id=video_url'&fldr=videos"
                );
                break;
            default:
                $(iframe).attr(
                    'src',
                    "/admins/filemanager/dialog.php?type=1&field_id=txtFeaturedImage'&fldr="
                );
        }
        uploadImageModal.toggle();
    });

});
