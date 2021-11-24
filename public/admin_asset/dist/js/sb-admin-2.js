/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});

function BrowseServer()
{
    var finder = new CKFinder();
    finder.BasePath = 'admin_asset/ckeditor/ckfinder/';
    finder.SelectFunction = SetFileField;
    finder.Popup();
}
function SetFileField(fileUrl)
{
    document.getElementById('image').value = fileUrl;
}

// category
$(document).ready(function(){
    $("input#view").blur(function(){
        var view = $(this).val();
        var cid = $(this).parents('.editview').find('input[name="cid"]').val();
        // alert(view);
        $.ajax({
            url:  'admin/ajax/updateview/'+cid,
            type: 'GET',
            cache: false,
            data: {
                "view":view,
                "cid":cid
            },
            // success: function(data){
            //     $('#data-cat').html(data);
            // }
        });
    });
});
$(document).ready(function(){
    $("input#status").click(function(){
        var status = $(this).is(':checked');
        var cid = $(this).parents('.editview').find('input[name="cid"]').val();
        // alert(cid);
        $.ajax({
            url:  'admin/ajax/updatestatus/'+cid,
            type: 'GET',
            cache: false,
            data: {
                "status":status,
                "cid":cid
            },
            // success: function(data){
            //     $('#data-cat').html(data);
            // }
        });
    });
});
$(document).ready(function(){
    $("#sort_by").change(function(){
        var sort_by = $(this).val();
        $.get("admin/ajax/sort_by/"+sort_by,function(data){
            $("#parent").html(data);
        });
    });

});
// end category

// product
$(document).ready(function(){
    // alert('ok');
    $("#city").change(function(){
        var city_id = $(this).val();
        // alert(city_id)
        $.get("admin/ajax/location/"+city_id,function(data){
            $("#dis").html(data);
        });
    });

});

$(document).ready(function(){
    $("input#productstatus").click(function(){
        var status = $(this).is(':checked');
        var pid = $(this).parents('.img').find('input[name="pid"]').val();
        // alert(pid);
        $.ajax({
            url:  'admin/ajax/productstatus/'+pid,
            type: 'GET',
            cache: false,
            data: {
                "status":status,
                "pid":pid
            },
            // success: function(data){
                // $('#data-pro').html(data);
            // }
        });
    });
    $("input#hot").click(function(){
        var hot = $(this).is(':checked');
        var pid = $(this).parents('.img').find('input[name="pid"]').val();
        // alert(pid);
        $.ajax({
            url:  'admin/ajax/producthot/'+pid,
            type: 'GET',
            cache: false,
            data: {
                "hot":hot,
                "pid":pid
            },
            // success: function(data){
                // $('#data-pro').html(data);
            // }
        });
    });
});
$(document).ready(function(){
    $("input#del").click(function(){
        var id = $(this).parents('.detail-img').find('input[name="id"]').val();
        // alert(id);
        $.ajax({
            url:  'admin/ajax/delproductimages/'+id,
            type: 'GET',
            cache: false,
            data: {
                "id":id
            },
            // success: function(data){
            //     $('#imgdetail').html(data);
            // }
        });
    });
});
// end product

// news
$(document).ready(function(){
    $("input#newstatus").click(function(){
        var status = $(this).is(':checked');
        var nid = $(this).parents('.img').find('input[name="nid"]').val();
        // alert(status);
        $.ajax({
            url:  'admin/ajax/newstatus/'+nid,
            type: 'GET',
            cache: false,
            data: {
                "status":status,
                "nid":nid
            },
            // success: function(data){
                // $('#data-pro').html(data);
            // }
        });
    });

    $("input#newhot").click(function(){
        var hot = $(this).is(':checked');
        var nid = $(this).parents('.img').find('input[name="nid"]').val();
        // alert(status);
        $.ajax({
            url:  'admin/ajax/newhot/'+nid,
            type: 'GET',
            cache: false,
            data: {
                "hot":hot,
                "nid":nid
            },
            // success: function(data){
                // $('#data-pro').html(data);
            // }
        });
    });
});
// end news

// dataTables
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
// end dataTables

// upload img
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);
        } else {
    removeUpload();
    }
}
// end upload img

// product
$(document).ready(function(){
    $("input#saleof").click(function(){
        $("#price_old").toggleClass("display");
    });
});

// end product

// seo
function change (el) {
    var max_desc = 170;
    if (el.value.length > max_desc) {
        el.value = el.value.substr(0, max_desc);
    }
    document.getElementById('chars_left').innerHTML = max_desc - el.value.length;
    return true;
}
function changetitle (el) {
    var max_title = 70;
    if (el.value.length > max_title) {
        el.value = el.value.substr(0, max_title);
    }
    document.getElementById('chars_title').innerHTML = max_title - el.value.length;
    return true;
}

$(function(){
    $("input#title").keyup(function () {
        var value = $(this).val();
        $(".seo-title").text(value);
    }).keyup();
});

$(function(){
    $("input#description").keyup(function () {
        var value = $(this).val();
        $(".seo-description").text(value);
    }).keyup();
});
// end seo

