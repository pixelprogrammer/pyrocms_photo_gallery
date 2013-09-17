/*
    Name: gallery.js
    Description: This script adds ajax functions to add and remove photos from the gallery
    Version: 0.1.0
    Author: Joseph McMurray
 */

$(document).ready(function() {
    // attach all the add image events to the images
    var add_image_selector = $('.add-image');
    attach_add_event(add_image_selector);
});

function attach_add_event(selector) {
    // selector.click(ajax_add_image);
    selector.on('click', ajax_add_image);
}

function attach_remove_event(selector) {
    selector.on('click', ajax_remove_image);
}

function ajax_add_image() {
    console.log('Adding image');
    var _this = this;

    $.ajax({
        url: SITE_URL + 'admin/photo_gallery/add_image/ajax',
        type: 'post',
        dataType: 'json',
        data: {
            gallery_id: $('input[name="gallery_id"]').val(),
            image_id: $(this).attr('data-id')
        },
        success: function(data) {
            if(data.type == 'error') {
                add_error_message(data.message);
            } else {
                if(data.location == 'added') {
                    add_image(data, _this);
                } else {
                    remove_image(data, _this);
                }
            }
        },
        error: error_handler
    });

    return false;
}

function ajax_remove_image() {
    console.log('removing image...');
    return false;
}

function remove_image(data) {
    console.log('Image Removed');
    add_error_message(data.message);
}

function add_image(data, image) {
    move_image(data.location, image);
    $(image).off().on('click', ajax_remove_image);
    add_success_message(data.message);
}

function move_image(location, image) {
    var new_location = '#remove-photos';
    if(location != 'added') {
        new_location = '#add-photos';
    }
    $(image).fadeOut(200, function() {
        $(this).appendTo(new_location);
    }).fadeIn(200);
}

function add_success_message(message) {
    $('<div/>').addClass('alert success').html(message).prependTo('.content').fadeIn(200).delay(5000).fadeOut(200, function() {
        $(this).remove();
    });
}

function add_error_message(message) {
    $('<div/>').addClass('alert error').html(message).prependTo('.content').fadeIn(200).delay(5000).fadeOut(200, function() {
        $(this).remove();
    });
}

function error_handler(xhr) {
    // do stuff with errors here
}