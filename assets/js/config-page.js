jQuery( document ).ready(function($) {});
$ = jQuery;

function uploadSticker(name){
    var media_frame;
    event.preventDefault();

    if ( media_frame ) {
        media_frame.open();
        return;
    }

    media_frame = wp.media({
        title: 'Select uma imagem para fazer upload',
        button: {
          text: 'Usar essa imagem',
        },
        library: {
            type: 'image',
        },
        multiple: false,
        
    });

    media_frame.on( 'select', function() {
        let id = new Date().getTime();
        var media = media_frame.state().get('selection').first().changed.url;

        let sticker_area = $("<span id='sticker-"+id+"' class='sticker-item-list'></span>");
        let sticker_delete_icon = $("<span class='dashicons dashicons-trash' onclick='deleteSticker("+id+")'></span>");
        let sticker_image = $("<img src="+media+" />");
        sticker_area.append(sticker_delete_icon);
        sticker_area.append(sticker_image);

        $('.stickers-list').append(sticker_area)
        if(script_values.stickers == null) {
            script_values.stickers = {}; 
        }
        script_values.stickers[id] = media;
    });

    media_frame.open();
}

function saveStickerList(siteUrl){    
    if(script_values.stickers != null){
        $.post(siteUrl + '/wp-json/sc/v1/save_stickers', script_values, function(response){
            $(".alert-info").fadeIn(400);
        })
    }
}

function deleteSticker(id){
    $("#sticker-" + id).remove();
    delete script_values.stickers[id]
}

function closeAlert(){
    $(".alert").fadeOut(400);
}