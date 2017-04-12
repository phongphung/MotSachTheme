jQuery(document).ready(function($){

    var mediaUploader;

    $( '#upload-button' ).on('click',function(e){
        e.preventDefault();
        
        if( mediaUploader ){
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false
        });

        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $( '#motsach-remove-profile-picture' ).on('click', function(e){
        e.preventDefault();
        answer = confirm('Do you want to remove profile picture?');
        if ( answer ){
            $('#profile-picture').val('');
            $('.motsach-general-form').submit();
            //$('#profile-picture-preview').css('background-image', 'url()');
        }


    });
})

