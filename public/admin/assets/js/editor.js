function ckeditor (name) {
    CKEDITOR.replace( name ,{
        filebrowserBrowseUrl : baseURL +'ckfinder/browser',
    });
}

function openPopup(id_attribute) {
    CKFinder.popup( {
        chooseFiles: true,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                document.getElementById(id_attribute).value = file.getUrl();
                $("#image_avatar").attr("src", file.getUrl());
                $(".remove_image").prop('disabled', false);
            } );
            finder.on( 'file:choose:resizedImage', function( evt ) {
                document.getElementById(id_attribute).value = evt.data.resizedUrl;
                $("#image_avatar").attr("src", evt.data.resizedUrl);
                $(".remove_image").prop('disabled', false);
            } );
        }
    } );
}

if(document.getElementById("album") != null){
    var albumValues = document.getElementById("album").value;
    var array_images = albumValues ? albumValues.split(",")  : [];
}

function openAlbumImage(id_attribute, countImage) {
    var count = 0;
    if (countImage > 0){
        count = countImage;
    }
    CKFinder.popup({
        chooseFiles: true,
        chooseFilesClosePopup: false,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var html = $("<div class=\"col-lg-3 text-center mb-5 height-album\" id=\"image-"+ count +"\">\n" +
            "                    <div class=\"position-relative border-dark border p-3\">\n" +
            "                      <img src=\"" + file.getUrl() + "\" class=\"w-100 image-album mb-2\" />\n" +
            "                      <a onclick=\"removeImageFromArray('image-"+ count +"')\" href='javascript:void(0)' class=\"ico-remove-image btn-danger btn text-center btn-xs\">\n" +
            "                        <i class=\"ti-trash\"></i>\n" +
            "                      </a>\n" +
            "                    </div>\n" +
            "                  </div>")
                $("#list-image-album").append(html);
                count = count + 1;
                array_images.push(file.getUrl());
                document.getElementById("album").value = array_images;
            });
        }
    });
}

function removeImageFromArray(idElement){
    document.getElementById(idElement).remove();
    array_images.splice(idElement, 1);
    document.getElementById("album").value = array_images;
}

function slugify(slug) {
    var str = slug;
    str = str.toLowerCase();
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
    return str;
}

$(document).ready(function(){
    $('.editor').each(function(){
        $this = $(this);
        ckeditor($this.attr('name'));
    });
    if($('input[maxlength]').length > 0){
        $('input[maxlength]').maxlength({
            alwaysShow: true,
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger",
            separator: ' of ',
            preText: 'You have ',
            postText: ' chars remaining.',
            placement: 'top',
            validate: true
        });
    }

    if($('textarea[maxlength]').length > 0){
        $('textarea[maxlength]').maxlength({
            alwaysShow: true,
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger",
            separator: ' of ',
            preText: 'You have ',
            postText: ' chars remaining.',
            placement: 'top',
            validate: true
        });
    }

    $('.get_image').click(function(event){
        event.stopPropagation();
        openPopup($(this).attr('data-avatar'));
    });

    $('.remove_image').click(function(event){
        event.stopPropagation();
        $("#image_avatar").attr("src", baseURL+ 'admin/assets/images/no_img.jpg');
        document.getElementById('avatar').value = '';
    });

    $(document).on('change', '.name', function() {
        document.getElementById($(this).attr('data-slug')).value = slugify($(this).val());
    });

    $(document).on('change', '.name-widget', function() {
        document.getElementById($(this).attr('data-slug')).value = "[code]"+ slugify($(this).val()) + "[/code]";
        document.getElementById($(this).attr('data-alias')).value = slugify($(this).val());
    });

    if((".select2").length > 0){
        $('.select2').each(function(){
            $(this).select2({
                width: '100%'
            });
        });
    }

    if(("#get_album").length > 0){
        $('#get_album').click(function(event){
            event.stopPropagation();
            openAlbumImage($(this).attr('data-avatar'), parseInt($(this).attr('data-count')));
        });
    }
});
